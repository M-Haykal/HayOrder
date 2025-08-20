<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Restaurant $restaurant) {
        $categories = $restaurant->categories;

        return view('owner.pages.category', compact('categories', 'restaurant'));
    }
}
