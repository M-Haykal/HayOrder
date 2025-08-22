<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class OwnerController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $restaurant->loadCount(['categories', 'menus', 'tables', 'orders']);

        return view('owner.pages.dashboard', [
            'restaurant' => $restaurant,
        ]);
    }
}
