<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelilingSegitigaController extends Controller
{
    public function hitungKeliling(Request $request)
    {
        // Validate input
        $request->validate([
            'sisiA' => 'required|numeric|min:0',
            'sisiB' => 'required|numeric|min:0',
            'sisiC' => 'required|numeric|min:0',
        ]);

        // Validate triangle formation
        if ($request->sisiA + $request->sisiB <= $request->sisiC ||
            $request->sisiA + $request->sisiC <= $request->sisiB ||
            $request->sisiB + $request->sisiC <= $request->sisiA) {
            return response()->json(['error' => 'Tidak dapat membentuk segitiga'], 422);
        }

        // Calculate the perimeter
        $keliling = $request->sisiA + $request->sisiB + $request->sisiC;

        // Return JSON response with success message and API information
        return response()->json([
            'status' => 'success',
            'message' => 'Keliling segitiga adalah: ' . $keliling,
            'api' => 'API Hitung Keliling Segitiga',
            'developer' => 'Rahmat Subandrio',
        ], 200);
    }
}