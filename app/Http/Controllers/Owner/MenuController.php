<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $menus = $restaurant->menus()->paginate(5);
        // dd($menus);
        $categories = $restaurant->categories;
        return view('owner.pages.menu', compact('categories', 'menus', 'restaurant'));
    }

    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_menu.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        $paths = [];
        if ($request->hasFile('image_menu')) {
            foreach ($request->file('image_menu') as $file) {
                $paths[] = $file->store('menus', 'public');
            }
        }

        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image_menu' => json_encode($paths),
            'category_id' => $request->category_id,
            'restaurant_id' => $restaurant->id,
        ]);

        return redirect()->back()->with('success', 'Menu created successfully.');
    }

    public function update(Request $request, Restaurant $restaurant, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_menu.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $path = $menu->image_menu;

        if ($request->hasFile('image_menu')) {
            if ($menu->image_menu) {
                Storage::disk('public')->delete($menu->image_menu);
            }
            $path = $request->file('image_menu')->store('menus', 'public');
        }

        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->image_menu = $path;
        $menu->category_id = $request->category_id;
        $menu->save();

        return redirect()->back()->with('success', 'Menu updated successfully.');
    }

    public function destroy(Restaurant $restaurant, Menu $menu)
    {
        if ($menu->image_menu) {
            Storage::disk('public')->delete($menu->image_menu);
        }

        $menu->delete();

        return redirect()->back()->with('success', 'Menu deleted successfully.');
    }
}
