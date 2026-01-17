<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private CartService $cartService)
    {
    }

    public function checkout()
    {
        $cart = $this->cartService->getCart();

        if (empty($cart['items'])) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout', [
            'cart' => $cart,
        ]);
    }

    public function store(CheckoutRequest $request)
    {
        $cart = $this->cartService->getCart();

        if (empty($cart['items'])) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $user = $request->user();

        $order = DB::transaction(function () use ($cart, $request, $user) {
            $order = Order::create([
                'user_id' => $user->id,
                'restaurant_id' => $cart['restaurant_id'],
                'status' => 'pending',
                'total' => $cart['total'],
                'delivery_address' => $request->input('delivery_address'),
                'phone' => $request->input('phone'),
                'notes' => $request->input('notes'),
            ]);

            foreach ($cart['items'] as $menuItemId => $item) {
                $order->items()->create([
                    'menu_item_id' => (int) $menuItemId,
                    'quantity' => $item['qty'],
                    'unit_price' => $item['price'],
                    'line_total' => $item['subtotal'],
                ]);
            }

            return $order;
        });

        $this->cartService->clear();

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully.');
    }

    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->with('restaurant')
            ->latest()
            ->paginate(10);

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Request $request, Order $order)
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }

        $order->load(['restaurant', 'items.menuItem']);

        return view('orders.show', [
            'order' => $order,
        ]);
    }
}
