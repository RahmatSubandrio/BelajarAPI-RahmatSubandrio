<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrapesiumController extends Controller
{
    public function hitungKeliling(Request $request)
    {
        // Validasi input
        $request->validate([
            'sisi_atas' => 'required|numeric',
            'sisi_bawah' => 'required|numeric',
            'sisi_miring1' => 'required|numeric',
            'sisi_miring2' => 'required|numeric',
        ]);

        // Hitung keliling
        $keliling = $request->sisi_atas + $request->sisi_bawah + $request->sisi_miring1 + $request->sisi_miring2;

        // Return JSON dengan pesan yang lebih informatif
        return response()->json([
            'message' => 'Hasil dari keliling trapesium adalah, makasih udah coba tools saya love u',
            'keliling' => $keliling
        ]);
    }
}