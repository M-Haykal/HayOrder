<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Table;
use Illuminate\Support\Facades\Storage;

class TableController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $tables = $restaurant->tables;
        return view('owner.pages.table', compact('tables','restaurant'));
    }

    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'table_number' => 'required|integer|unique:tables,table_number,NULL,id,restaurant_id,' . $restaurant->id,
        ]);

        $link = url("/restaurant/{$restaurant->slug}/table/{$request->table_number}/menu");

        $fileName = "table_{$restaurant->id}_{$request->table_number}.svg";

        $filePath = "table/" . $fileName;

        $qrCode = QrCode::format('svg')->size(300)->generate($link);
        Storage::disk('public')->put($filePath, $qrCode);

        $table = Table::create([
            'table_number' => $request->table_number,
            'qr_code_path' => $filePath, 
            'restaurant_id' => $restaurant->id,
        ]);

        return redirect()->back()->with('success', "Table {$request->table_number} berhasil ditambahkan dengan QR Code.");
    }

    public function destroy(Restaurant $restaurant, Table $table)
    {
        if ($table->qr_code_path) {
            Storage::disk('public')->delete($table->qr_code_path);
        }

        $table->delete();

        return redirect()->back()->with('success', 'Table berhasil dihapus.');
    }
}
