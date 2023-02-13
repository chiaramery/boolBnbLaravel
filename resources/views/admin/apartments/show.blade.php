@extends('layouts.admin')

@section('content')
    <div class="container">

        <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary mt-3"><i
                class="fa-solid fa-arrow-left"></i></a>
        <h3 class="text-center mb-3">Maggiori dettagli:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Stanze</th>
                    <th scope="col">Letti</th>
                    <th scope="col">Bagni</th>
                    <th scope="col">Metri Quadri</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col">Pubblicato da:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $apartment->title }}</td>
                    <td>{{ $apartment->rooms }}</td>
                    <td>{{ $apartment->beds }}</td>
                    <td>{{ $apartment->bathrooms }}</td>
                    <td>{{ $apartment->square_meters }}</td>
                    <td>{{ $apartment->address }}</td>
                    <td>{{ $owner->name }}</td>

                </tr>
            </tbody>
        </table>

        <div class="row">
            <h4>Servizi:</h4>
            @foreach ($apartment->services as $service)
                <p>- {{ $service->name }}</p>
            @endforeach
        </div>
        {{-- Mappa --}}
        <div id="map" style="height: 500px; width: 100%;"></div>
        {{-- Foto --}}
        <div class="slider">
            <h4>Immagini:</h4>
            <img src="{{ asset('storage/' . $apartment->image) }}" alt="">
        </div>



    @section('script')
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.48.0/maps/maps-web.min.js">
            let map = tt.map({
                key: 'upEwnVbILIY3XpQgAsiO3mhPUP6dQdCd',
                container: 'map',
                style: 'tomtom://vector/1/basic-main',
                center: [{{ $apartment->longitude }}, {{ $apartment->latitude }}],
                zoom: 10
            });
        </script>
    @endsection


</div>
@endsection
