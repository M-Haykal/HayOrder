<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_restaurant' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $validated['owner_id'] = Auth::id();

        $fileName = "restaurant/qr_code_" . time() . ".svg";

        $restaurant = Restaurant::create(array_merge($validated, [
            'qr_code_path' => "storage/{$fileName}",
        ]));

        $url = url("/restaurant/{$restaurant->slug}/report");

        $qrImage = QrCode::format('svg')
            ->size(300)
            ->generate($url);

        Storage::disk('public')->put($fileName, $qrImage);

        return redirect()->route('start')
            ->with('success', 'Restaurant created successfully with QR code.');
    }
}
