<?php

namespace App\Http\Controllers\Api\Promotions;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    public function index(Request $request)
    {
        $promotions = Promotion::all();
        return PromotionResource::collection($promotions);
    }
}
