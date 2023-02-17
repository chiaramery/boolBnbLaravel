<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $apartments = Apartment::where('user_id', Auth::user()->id)->get();

        // Esempio di filtro per titolo
        // if (count($request->all()) === 0) {
        // Nessuna ricerca effettuata
        //     $apartments = Apartment::where('user_id', Auth::user()->id)->get();
        // } elseif ($request->has('search_key_title')) {
        //     $apartments = Apartment::where([
        //         ['user_id', Auth::user()->id],
        //         ['title', 'like', "%$request->search_key_title%"],
        //     ])->get();
        // }

        return view('admin.apartments.userMessages', compact('apartments', 'leads'));
    }
}
