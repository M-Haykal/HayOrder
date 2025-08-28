<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\RestaurantDocument;

class OwnerController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $restaurant->loadCount(['categories', 'menus', 'tables', 'orders']);

        return view('owner.pages.dashboard', [
            'restaurant' => $restaurant,
        ]);
    }

    public function documents(Restaurant $restaurant)
    {
        $restaurant->load('restaurantDocuments'); // Sesuaikan dengan nama relasi di model

        return view('owner.pages.restaurant-document', compact('restaurant'));
    }

    public function storeDocument(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'document_type' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('file_path')->store('restaurant_documents', 'public');

        RestaurantDocument::create([
            'document_type' => $request->document_type,
            'file_path' => $path,
            'restaurant_id' => $restaurant->id,
        ]);

        return redirect()->route('start')->with('success', 'Document uploaded successfully.');
    }
}
