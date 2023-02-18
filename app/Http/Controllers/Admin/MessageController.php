<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $leads = Lead::whereIn('apartment_id', function ($query) use ($user) {
            $query->select('id')
                ->from('apartments')
                ->where('user_id', '=', $user->id);
        })->get();
        return view('admin.apartments.message', compact('leads'));
    }
}
