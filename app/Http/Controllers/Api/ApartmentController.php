<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $apartments = Apartment::with('services')->paginate(5);
        return response()->json([
            'success' => true,
            'results' => $apartments
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
