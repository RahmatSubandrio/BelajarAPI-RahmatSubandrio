<?php  
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelilingLingkaranController extends Controller
{
    public function hitungKeliling(Request $request)
    {
        // Validasi input
        $request->validate([
            'jariJari' => 'required|numeric|min:0',
        ]);

        // Hitung keliling lingkaran
        $keliling = 2 * pi() * $request->jariJari;

        // Kembalikan respons JSON
        return response()->json([
            'status' => 'success',
            'keliling' => $keliling,
            'api' => 'API Hitung Keliling Segitiga',
            'developer' => 'Rahmat Subandrio',
        ]);
    }
}