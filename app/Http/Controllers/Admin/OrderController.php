<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        // dd($promotions);
        return view('admin.promotion.index', compact('promotions'));
    }
}
