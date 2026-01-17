<?php

namespace App\Services;

use App\Models\MenuItem;

class CartService
{
    public function getCart(): array
    {
        return session('cart', [
            'restaurant_id' => null,
            'items' => [],
            'total' => 0,
        ]);
    }

    public function add(MenuItem $menuItem, int $quantity = 1): array
    {
        $cart = $this->getCart();

        if (empty($cart['restaurant_id'])) {
            $cart['restaurant_id'] = $menuItem->restaurant_id;
        }

        $items = $cart['items'];
        $itemId = (string) $menuItem->id;

        if (isset($items[$itemId])) {
            $items[$itemId]['qty'] += $quantity;
        } else {
            $items[$itemId] = [
                'name' => $menuItem->name,
                'price' => (float) $menuItem->price,
                'qty' => $quantity,
                'subtotal' => 0,
            ];
        }

        $cart['items'] = $items;
        $cart = $this->recalculate($cart);

        session(['cart' => $cart]);

        return $cart;
    }

    public function updateQuantity(int $menuItemId, int $quantity): array
    {
        $cart = $this->getCart();
        $itemId = (string) $menuItemId;

        if (! isset($cart['items'][$itemId])) {
            return $cart;
        }

        if ($quantity <= 0) {
            unset($cart['items'][$itemId]);
        } else {
            $cart['items'][$itemId]['qty'] = $quantity;
        }

        $cart = $this->recalculate($cart);
        session(['cart' => $cart]);

        return $cart;
    }

    public function remove(int $menuItemId): array
    {
        $cart = $this->getCart();
        $itemId = (string) $menuItemId;

        unset($cart['items'][$itemId]);

        $cart = $this->recalculate($cart);
        session(['cart' => $cart]);

        return $cart;
    }

    public function clear(): void
    {
        session()->forget('cart');
    }

    private function recalculate(array $cart): array
    {
        $total = 0;

        foreach ($cart['items'] as $itemId => $item) {
            $subtotal = (float) $item['price'] * (int) $item['qty'];
            $cart['items'][$itemId]['subtotal'] = round($subtotal, 2);
            $total += $subtotal;
        }

        $cart['total'] = round($total, 2);

        if (empty($cart['items'])) {
            $cart['restaurant_id'] = null;
        }

        return $cart;
    }
}
