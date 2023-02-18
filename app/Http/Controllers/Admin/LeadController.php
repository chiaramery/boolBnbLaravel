<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    //     public function index()
    //     {
    //         $userMessages = Lead::all();

    //         if (count($userMessages->all()) === 0) {
    //             $userMessages = Lead::where('apartment_id',
    //                 'user_id', Auth::user()->id)->get();
    //         };
    //         return view('admin.userMessages', compact('userMessages'));
    //     }
    // }

    public function show($id)
    {
        // ottieni l'utente loggato
        $user = Auth::user();

        // ottieni i messaggi per l'appartamento loggato
        $userMessages = Lead::where('apartment_id', $id)
            ->whereHas('apartment', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        // restituisci la vista con i messaggi
        return view('admin.userMessages', compact('userMessages'));
    }
}
