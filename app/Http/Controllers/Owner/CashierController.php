<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashierRestaurant;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CashierController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $cashiers = $restaurant->cashiers;

        // dd($cashiers);
        return view('owner.pages.cashier', compact('cashiers', 'restaurant'));
    }

    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'username'     => 'required|string|max:255',
            'nik'          => 'required|string|max:20|unique:cashier_restaurants,nik',
            'image_staff'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        

        $path = null;
        if ($request->hasFile('image_staff')) {
            $path = $request->file('image_staff')->store('staff_restaurant', 'public');
        }

        // dd($path);

        CashierRestaurant::create([
            'username'      => $request->username,
            'nik'           => Hash::make($request->nik),
            'image_staff'   => $path,
            'restaurant_id' => $restaurant->id,
        ]);

        return redirect()->back()->with('success', 'Cashier created successfully.');
    }

    public function update(Request $request, Restaurant $restaurant, CashierRestaurant $cashier)
    {
        $request->validate([
            'username'     => 'required|string|max:255',
            'nik'          => 'nullable|string|max:20|unique:cashier_restaurants,nik,' . $cashier->id,
            'image_staff'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $cashier->image_staff;

        if ($request->hasFile('image_staff')) {
            $path = $request->file('image_staff')->store('staff_restaurant', 'public');
        }

        $cashier->username = $request->username;
        $cashier->restaurant_id = $restaurant->id;

        if ($request->nik !== $cashier->getOriginal('nik')) {
            $cashier->nik = Hash::make($request->nik);
        }

        $cashier->image_staff = $path;
        $cashier->save();

        return redirect()->back()->with('success', 'Cashier updated successfully.');
    }


    public function destroy(Restaurant $restaurant, CashierRestaurant $cashier)
    {
        if ($cashier->image_staff) {
            Storage::disk('public')->delete($cashier->image_staff);
        }
        $cashier->delete();

        return redirect()->back()->with('success', 'Cashier deleted successfully.');
    }
}
