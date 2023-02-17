@extends('layouts.admin')

@section('content')
    <div class="container-show">
        {{-- Btn return --}}
        <a href="{{ route('admin.apartments.index') }}" class="btn-return"><i class="fa-solid fa-arrow-left"></i></a>

        <div class="title-show">
            <h3 class="t-show">{{ $apartment->title }}</h3>
            <p class="st-show">
                <i class="fa-solid fa-location-dot"></i>
                {{ $apartment->address }}
            </p>
        </div>
        <div class="wrap">
            <div class="img-show">
                <img src="{{ asset('storage/' . $apartment->image) }}" alt="">
            </div>
            <div class="card-info">
                <div class="info">
                    <h4 class="t-info">Informazioni</h4>
                    <div class="single-info">
                        <p class="t-s">Stanze</p>
                        <span class="n-i">{{ $apartment->rooms }}</span>
                    </div>
                    <div class="single-info">
                        <p class="t-s">Bagni</p>
                        <span class="n-i">{{ $apartment->bathrooms }}</span>
                    </div>
                    <div class="single-info">
                        <p class="t-s">Letti</p>
                        <span class="n-i">{{ $apartment->beds }}</span>
                    </div>
                    <div class="single-info">
                        <p class="t-s">Mq</p>
                        <span class="n-i">{{ $apartment->square_meters }}</span>
                    </div>
                </div>
                <!-- Service -->
                <div class="service">
                    <h4 class="t-info">Servizi</h4>
                    <div class="service-cat">
                        @foreach ($apartment->services as $service)
                            <div class="sp-i">
                                <span class="n-i">{{ $service->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        {{-- Mappa --}}

        <div class="cont-map mt-3">
            <a class="open text-center mt-3">
                Open Map
            </a>
            <div class="map-s mt-3">
                <h3 class="text-white">Mappa del luogo </h3>
                <div id="map" style="width: 350px; height: 350px;"></div>
            </div>
        </div>

        <script>
            const map = tt.map({
                key: "upEwnVbILIY3XpQgAsiO3mhPUP6dQdCd",
                container: "map",
                center: [{{ $apartment->longitude }}, {{ $apartment->latitude }}],
                zoom: 10
            });
            const marker = new tt.Marker()
                .setLngLat({{ $apartment->latitude }}, {{ $apartment->longitude }}, )
                .addTo(map);
        </script>
    </div>
@endsection
