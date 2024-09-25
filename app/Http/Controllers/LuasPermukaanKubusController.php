<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LuasPermukaanKubusController extends Controller
{
    public function hitungLuasPermukaan(Request $request)
    {
        // Validasi input
        $request->validate([
            'sisi' => 'required|numeric|min:0',
        ]);

        // Hitung luas permukaan kubus
        $luasPermukaan = 6 * pow($request->sisi, 2);

        // Kembalikan respons JSON
        return response()->json([
            'status' => 'success',
            'luasPermukaan' => $luasPermukaan,
            'api' => 'API Hitung Keliling Segitiga',
            'developer' => 'Rahmat Subandrio',
        ]);
    }
}
