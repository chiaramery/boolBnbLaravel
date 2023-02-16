<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $radius = $request->input('radius', 20000); // Raggio di default di 20 km

        $apartments = Apartment::with('services')
            ->selectRaw("*, (6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lng)) + sin(radians($lat)) * sin(radians(latitude)))) AS distance")
            ->whereRaw("(6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lng)) + sin(radians($lat)) * sin(radians(latitude)))) < $radius")
            ->orderBy('distance')
            ->paginate(5);

        return response()->json([
            'success' => true,
            'data' => $apartments
        ]);
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
                'error' => "Nessun progetto trovato",
            ]);
        }
    }
}
