<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $orders = $restaurant->orders()->paginate(5);
        return view('owner.pages.order', compact('orders', 'restaurant'));
    }
}
