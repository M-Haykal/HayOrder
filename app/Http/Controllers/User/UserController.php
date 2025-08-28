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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function showMenu(Request $request, Restaurant $restaurant, $table)
    {
        $menus = $restaurant->menus()->paginate(6);
        $categories = $restaurant->categories()->get();
        $table = $restaurant->tables()->where('id', $table)->firstOrFail();
        $orderCount = Order::where('table_id', $table->id)
            ->where('restaurant_id', $restaurant->id)
            ->where('status', 'pending')
            ->count();
        // dd($table);

        return view('user.menu', compact('restaurant', 'table', 'menus', 'categories', 'table', 'orderCount'));
    }

    public function store(Request $request, Restaurant $restaurant, $table)
    {
        $validated = $this->validateRequest($request);

        $table = $this->getTable($table);

        $order = $this->createOrder($validated, $table, $restaurant);

        $this->processOrderItems($order, $validated['items']);

        return response()->json([
            'message' => 'Order placed successfully',
            'order' => $order
        ]);
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'note_order' => 'nullable|string',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);
    }

    private function getTable($tableId)
    {
        return Table::findOrFail($tableId);
    }

    private function createOrder($validated, $table, $restaurant)
    {
        $order = new Order();
        $order->name = $validated['name'];
        $order->total_price = 0; // Will be calculated below
        $order->status = 'pending';
        $order->code_order = $this->generateCodeOrder();
        $order->note_order = $validated['note_order'];
        $order->table_id = $table->id;
        $order->restaurant_id = $restaurant->id;
        $order->save();

        return $order;
    }

    private function generateCodeOrder()
    {
        return 'ORD-' . Str::random(5);
    }

    private function processOrderItems(Order $order, array $items)
    {
        $totalPrice = 0;

        foreach ($items as $item) {
            $menu = Menu::find($item['menu_id']);

            $orderItem = new OrderItem();
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->order_id = $order->id;
            $orderItem->menu_id = $item['menu_id'];
            $orderItem->restaurant_id = $order->restaurant_id;
            $orderItem->save();

            $totalPrice += $item['quantity'] * $item['price'];
        }

        $order->total_price = $totalPrice;
        $order->save();
    }
}
