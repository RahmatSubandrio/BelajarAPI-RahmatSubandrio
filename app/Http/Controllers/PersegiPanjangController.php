<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersegiPanjangController extends Controller
{
    public function hitungLuas(Request $request)
    {
        // Validasi input
        $request->validate([
            'panjang' => 'required|numeric|min:0',
            'lebar' => 'required|numeric|min:0',
        ]);

        // Hitung luas
        $luas = $request->panjang * $request->lebar;

        // Return JSON dengan pesan sukses atau gagal
        return response()->json([
            'status' => 'success',
            'message' => 'Hasil perhitungan luas persegi panjang adalah: ' . $luas,
        ], 200);
    }
}