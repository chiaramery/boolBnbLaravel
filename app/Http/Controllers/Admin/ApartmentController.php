<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\TomTomController;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Service;
use App\Models\User;
use App\Support\getDataFromAPI;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

use function App\Support\getDataFromAPI;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $apartments = Apartment::where('user_id', Auth::user()->id)->get();

        // Esempio di filtro per titolo
        if (count($request->all()) === 0) {
            // Nessuna ricerca effettuata
            $apartments = Apartment::where('user_id', Auth::user()->id)->get();
        } elseif ($request->has('search_key_title')) {
            $apartments = Apartment::where([
                ['user_id', Auth::user()->id],
                ['title', 'like', "%$request->search_key_title%"],
            ])->get();
        }

        return view('admin.apartments.index', compact('apartments'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $services = Service::all();
        return view('admin.apartments.create', compact('services', 'users'));
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
        $data['user_id'] = Auth::id();
        // dd($data);
        if ($request->hasFile('image')) {
            $path = Storage::put('images', $request->image);
            $data['image'] = $path;
        }
        $apiurl = "https://api.tomtom.com/search/2/geocode/" . $data['address'] . ".json?key=XIQDzXTSiVqrAm7kwopEwUIOyhLDXsNY";
        $client = new \GuzzleHttp\Client(["verify" => false]);
        $response = $client->request('GET', $apiurl);
        $chiamata_api =  json_decode($response->getBody(), true);
        $longitudine  = $chiamata_api['results'][0]['position']['lat'];
        $latitudine = $chiamata_api['results'][0]['position']['lon'];


        $data['longitude']  = $longitudine;
        $data['latitude'] = $latitudine;


        $new_apartment = Apartment::create($data);
        // $apartment = Apartment::create($data);
        //Se services esiste 

        if ($request->has('services')) {
            //Inseriamo i nuovi servizi nell'appartamento
            $new_apartment->services()->attach($request['services']);
        }


        return redirect()->route('admin.apartments.index')->with('message', "Il nuovo appartamento $new_apartment->title è stato aggiunto!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment, User $user)
    {

        $owner = User::findOrFail($apartment->user_id);
        return view('admin.apartments.show', compact('apartment', 'user', 'owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
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
        $this->authorize('update', $apartment);
        $data = $request->validated();
        $data['slug'] = Apartment::generateSlug($data['title'], $data['address']);
        if ($request->hasFile('image')) {
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }
            $path = Storage::put('images', $request->image);
            $data['image'] = $path;
        }
        $apiurl = "https://api.tomtom.com/search/2/geocode/" . $data['address'] . ".json?key=XIQDzXTSiVqrAm7kwopEwUIOyhLDXsNY";
        $client = new \GuzzleHttp\Client(["verify" => false]);
        $response = $client->request('GET', $apiurl);
        $chiamata_api =  json_decode($response->getBody(), true);
        $longitudine  = $chiamata_api['results'][0]['position']['lat'];
        $latitudine = $chiamata_api['results'][0]['position']['lon'];


        $data['longitude']  = $longitudine;
        $data['latitude'] = $latitudine;

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

    public function search(Request $request)
    {
        $services = Service::all();


        if (count($request->all()) === 0) {
            // Nessuna ricerca effettuata
            $apartments = Apartment::where('user_id', Auth::user()->id)->get();
        } elseif ($request->has('title')) {
            $apartments = Apartment::where([
                ['user_id', Auth::user()->id],
                ['title', 'like', "%$request->title%"],
                ['address', 'like', "%$request->address%"],
                ['rooms', 'like', "%$request->rooms%"],
                ['beds', 'like', "%$request->beds%"],

            ])->get();
        }



        return view('admin.apartments.search',  compact('apartments', 'services'));
    }
}
