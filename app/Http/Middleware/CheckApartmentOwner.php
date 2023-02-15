<?php

namespace App\Http\Middleware;

use App\Models\Apartment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CheckApartmentOwner
{


    public function handle(Request $request, Closure $next)
    {
        $apartment = Apartment::where('slug', $request->route('apartmentSlug'))->firstOrFail();

        if (auth()->user()->id === $apartment->user_id) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
