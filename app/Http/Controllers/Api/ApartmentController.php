<?php

namespace App\Http\Controllers\Api;

use Ajarunthomas\Facades\Haversine;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class ApartmentController extends Controller
{

    public function index(Request $request)
    {
        $lat = $request->latitude;
        $lng = $request->longitude;

        $apartment = DB::table('apartments')
            ->select('*')
            ->whereRaw('(6371 * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $lng . ')) + sin(radians(' . $lat . ')) * sin(radians(latitude)))) <= 20')
            ->get();


        if ($apartment) {
            return response()->json([
                'success' => true,
                'apartment' => $apartment,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => "Nessun Appartamento trovato",
            ]);
        }
    }

    public function show($slug)
    {
        $apartment = Apartment::with('services')->where('slug', $slug)->first();
        if ($apartment) {
            return response()->json([
                'success' => true,
                'apartment' => $apartment,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => "Nessun Appartamento trovato",
            ]);
        }
    }
}
