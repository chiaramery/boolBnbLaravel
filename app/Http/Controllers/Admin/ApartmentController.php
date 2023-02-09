<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Apartment::generateSlug($data['title'], $data['address']);
        // dd($data);
        if ($request->hasFile('image')) {
            $path = Storage::put('images', $request->image);
            $data['image'] = $path;
        }
        $new_apartment = Apartment::create($data);
        // $apartment = Apartment::create($data);
        //Se services esiste 
        if ($request->has('services')) {
            //Inseriamo i nuovi servizi nell'appartamento
            $new_apartment->services()->attach($request->service);
        }
        return redirect()->route('admin.apartments.index')->with('message', "Il nuovo appartamento $new_apartment->title è stato aggiunto!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment, Service $service)
    {
        $services = Service::all();
        return view('admin.apartments.edit', compact('apartment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $data = $request->validated();
        $data['slug'] = Apartment::generateSlug($data['title'], $data['address']);
        if ($request->hasFile('image')) {
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }
            $path = Storage::put('images', $request->image);
            $data['image'] = $path;
        }
        $apartment->update($data);
        if ($request->has('services')) {
            $apartment->services()->sync($request->services);
        } else {
            $apartment->services()->detach();
        }
        return redirect()->route('admin.apartments.index')->with('message', "$apartment->title è stato modificato correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect()->route('admin.apartments.index')->with('message', "L'appartamento $apartment->title è stato eliminato correttamente!");
    }
}
