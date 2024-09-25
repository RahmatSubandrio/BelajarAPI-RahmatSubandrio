<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelilingPersegiPanjangController extends Controller
{
    public function hitungKeliling(Request $request)
    {
        // Validasi input
        $request->validate([
            'panjang' => 'required|numeric|min:0',
            'lebar' => 'required|numeric|min:0',
        ]);

        // Hitung keliling
        $keliling = 2 * ($request->panjang + $request->lebar);

        // Return JSON dengan pesan sukses
        return response()->json([
            'status' => 'success',
            'message' => 'Keliling persegi panjang adalah: ' . $keliling,
        ], 200);
    }
}