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

    public function all(Request $request)
    {

        $apartments = Apartment::with('services')
            ->leftJoin('apartment_promotion', 'apartments.id', '=', 'apartment_promotion.apartment_id')
            ->orderBy('apartment_promotion.is_active', 'DESC')
            ->get();

        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }

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
    public function filter(Request $request)
    {

        $query = DB::table('apartments')
            ->leftJoin('apartment_promotion', 'apartments.id', '=', 'apartment_promotion.apartment_id')
            ->orderByDesc('apartment_promotion.is_active');

        // Filtri di ricerca
        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', $request->input('bathrooms'));
        }
        if ($request->filled('beds')) {
            $query->where('beds', $request->input('beds'));
        }
        if ($request->filled('rooms')) {
            $query->where('rooms', $request->input('rooms'));
        }

        // Filtri dei servizi
        if ($request->filled('services')) {
            $services = $request->input('services');
            $query->where(function ($query) use ($services) {
                foreach ($services as $service) {
                    $query->orWhereExists(function ($query) use ($service) {
                        $query->select(DB::raw(1))
                            ->from('apartment_service')
                            ->whereRaw('apartment_service.apartment_id = apartments.id')
                            ->where('apartment_service.service_id', $service);
                    });
                }
            });
        }

        // Eseguire la query
        $apartments = $query->get();
        return response()->json([
            'success' => true,
            'apartments' => $apartments,
        ]);

        // Eseguire la query

    }
}
