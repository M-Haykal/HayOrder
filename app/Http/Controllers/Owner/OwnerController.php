<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Table;
use App\Models\Order;
use App\Models\Category;

class OwnerController extends Controller
{
    public function index($slug)
    {
        $categories = Category::where('restaurant_slug', $slug)->count();
        $menus = Menu::where('restaurant_slug', $slug)->count();
        $tables = Table::where('restaurant_slug', $slug)->count();
        $orders = Order::where('restaurant_slug', $slug)->count();
        return view('owner.pages.dashboard', compact('slug', 'categories', 'menus', 'tables', 'orders'));
    }
}
