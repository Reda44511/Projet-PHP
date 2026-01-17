<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService)
    {
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $restaurant = null;

        if (! empty($cart['restaurant_id'])) {
            $restaurant = Restaurant::find($cart['restaurant_id']);
        }

        return view('cart.index', [
            'cart' => $cart,
            'restaurant' => $restaurant,
        ]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'menu_item_id' => ['required', 'exists:menu_items,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $menuItem = MenuItem::with('restaurant')->findOrFail($data['menu_item_id']);

        if (! $menuItem->is_available || ! $menuItem->restaurant?->is_active) {
            return back()->with('error', 'This item is not available right now.');
        }

        $cart = $this->cartService->getCart();

        if (! empty($cart['restaurant_id']) && (int) $cart['restaurant_id'] !== (int) $menuItem->restaurant_id) {
            return back()->with('error', 'Your cart already has items from another restaurant. Please remove them first.');
        }

        $quantity = (int) ($data['quantity'] ?? 1);
        $this->cartService->add($menuItem, $quantity);

        return back()->with('success', 'Item added to cart.');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'menu_item_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $this->cartService->updateQuantity((int) $data['menu_item_id'], (int) $data['quantity']);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'menu_item_id' => ['required', 'integer'],
        ]);

        $this->cartService->remove((int) $data['menu_item_id']);

        return back()->with('success', 'Item removed from cart.');
    }
}
