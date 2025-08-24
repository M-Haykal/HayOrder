<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function showMenu(Request $request, Restaurant $restaurant, $table)
    {
        $menus = $restaurant->menus()->get();
        $categories = $restaurant->categories()->get();
        $table = $restaurant->tables()->where('id', $table)->firstOrFail();
        // dd($table);

        return view('user.menu', compact('restaurant', 'table', 'menus', 'categories', 'table'));
    }

    // public function addToOrder(Request $request)
    // {
    //     $validated = $request->validate([
    //         'menu_id' => 'required|exists:menus,id',
    //         'table_id' => 'required|exists:tables,id',
    //         'restaurant_id' => 'required|exists:restaurants,id',
    //         'quantity' => 'nullable|integer|min:1',
    //     ]);

    //     $quantity = $request->input('quantity', 1);
    //     $menu = Menu::findOrFail($validated['menu_id']);
    //     $table = Table::findOrFail($validated['table_id']);
    //     $restaurant = Restaurant::findOrFail($validated['restaurant_id']);

    //     if ($table->restaurant_id !== $restaurant->id) {
    //         return redirect()->back()->with('error', 'Invalid table for this restaurant.');
    //     }

    //     $order = Order::where('table_id', $validated['table_id'])
    //         ->where('restaurant_id', $validated['restaurant_id'])
    //         ->where('status', 'pending')
    //         ->first();

    //     if (!$order) {
    //         $order = Order::create([
    //             'name' => 'Order for Table ' . $table->table_number,
    //             'total_price' => 0,
    //             'status' => 'pending',
    //             'note_order' => '',
    //             'restaurant_id' => $validated['restaurant_id'],
    //             'table_id' => $validated['table_id'],
    //         ]);
    //     }

    //     // Add or update the OrderItem (if it already exists, increment quantity)
    //     $orderItem = OrderItem::updateOrCreate(
    //         [
    //             'order_id' => $order->id,
    //             'menu_id' => $validated['menu_id'],
    //         ],
    //         [
    //             'quantity' => DB::raw('quantity + ' . $quantity), // Increment if exists
    //             'price' => $menu->price * $quantity,
    //             'restaurant_id' => $validated['restaurant_id'],
    //         ]
    //     );

    //     // Update the order's total_price
    //     $order->total_price = $order->orderItems()->sum('price');
    //     $order->save();

    //     return redirect()->back()->with('success', 'Item added to your order!');
    // }
}
