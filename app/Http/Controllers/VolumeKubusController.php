<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolumeKubusController extends Controller
{
    public function hitungVolume(Request $request)
    {
        // Validasi input
        $request->validate([
            'sisi' => 'required|numeric|min:0',
        ]);

        // Hitung volume kubus
        $volume = pow($request->sisi, 3);

        // Kembalikan respons JSON
        return response()->json([
            'status' => 'success',
            'volume' => $volume,
            'api' => 'API Hitung Keliling Segitiga',
            'developer' => 'Rahmat Subandrio',
        ]);
    }
}