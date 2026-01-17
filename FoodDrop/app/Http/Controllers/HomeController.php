<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search', ''));
        $category = trim((string) $request->get('category', ''));

        $restaurantsQuery = Restaurant::query()->where('is_active', true);

        if ($search !== '') {
            $restaurantsQuery->where('name', 'like', '%'.$search.'%');
        }

        if ($category !== '') {
            $restaurantsQuery->where('category', $category);
        }

        $restaurants = $restaurantsQuery
            ->orderBy('name')
            ->paginate(9)
            ->withQueryString();

        $categories = Restaurant::query()
            ->where('is_active', true)
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('home', [
            'restaurants' => $restaurants,
            'categories' => $categories,
            'search' => $search,
            'category' => $category,
        ]);
    }
}
