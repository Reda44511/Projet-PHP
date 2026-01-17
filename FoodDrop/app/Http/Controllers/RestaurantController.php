<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
class RestaurantController extends Controller
{
    public function show(Restaurant $restaurant)
    {
        if (! $restaurant->is_active) {
            abort(404);
        }

        $menuItems = $restaurant->menuItems()
            ->where('is_available', true)
            ->orderBy('name')
            ->get();

        return view('restaurants.show', [
            'restaurant' => $restaurant,
            'menuItems' => $menuItems,
        ]);
    }
}
