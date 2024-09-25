<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LuasSegitigaController extends Controller
{
    public function hitungLuas(Request $request)
    {
        // Validasi input
        $request->validate([
            'alas' => 'required|numeric|min:0',
            'tinggi' => 'required|numeric|min:0',
        ]);

        // Hitung luas
        $luas = 0.5 * $request->alas * $request->tinggi;

        // Return JSON dengan pesan sukses dan nama Anda
        return response()->json([
            'status' => 'success',
            'message' => 'Luas segitiga adalah: ' . $luas . ' (Hitung oleh API by Rahmat Subandrio)',
        ], 200);
    }
}