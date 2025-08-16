<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class UserController extends Controller
{
    public function showMenu(Request $request, $slug, $table_number)
    {
        $tables = Menu::where('restaurant_slug', $slug)
            ->where('table_number', $table_number)
            ->get();
        return view('user.menu', compact('slug', 'table_number', 'tables'));
    }
}
