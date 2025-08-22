<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $categories = $restaurant->categories;

        return view('owner.pages.category', compact('categories', 'restaurant'));
    }

    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_category' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path =  $request->file('image_category')->store('categories', 'public');

        Category::create([
            'name' => $request->name,
            'image_category' => $path,
            'restaurant_id' => $restaurant->id,
        ]);

        return redirect()->back()->with('success', 'Category created successfully.');
    }


    public function update(Request $request, Restaurant $restaurant, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_category' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_category')) {
            if ($category->image_category) {
                Storage::disk('public')->delete($category->image_category);
            }
            $path = $request->file('image_category')->store('categories', 'public');
            $category->image_category = $path;
        }

        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Restaurant $restaurant, Category $category)
    {
        if ($category->image_category) {
            Storage::disk('public')->delete($category->image_category);
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
