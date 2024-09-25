<?php
// app/Http/Controllers/LingkaranController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LingkaranController extends Controller
{
    public function luas(Request $request)
    {
        // Validasi input
        $request->validate([
            'jariJari' => 'required|numeric|min:0',
        ]);

        // Hitung luas lingkaran
        $luas = pi() * pow($request->jariJari, 2);

        // Kembalikan respons JSON
        return response()->json([
            'status' => 'success',
            'luas' => $luas,
            'api' => 'API Hitung Keliling Segitiga',
            'developer' => 'Rahmat Subandrio',
        ]);
    }
}