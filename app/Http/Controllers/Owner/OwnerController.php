<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class OwnerController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $restaurant = Restaurant::withCount(['categories', 'menus', 'tables', 'orders'])
            ->where('slug', $restaurant->slug)
            ->firstOrFail();

        return view('owner.pages.dashboard', [
            'restaurant' => $restaurant,
            'categories' => $restaurant->categories_count,
            'menus' => $restaurant->menus_count,
            'tables' => $restaurant->tables_count,
            'orders' => $restaurant->orders_count,
        ]);
    }
}
