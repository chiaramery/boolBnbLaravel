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



<form method="POST" action="{{route('admin.orders.makePayment')}}">
    @csrf
    <h2 class="text-center mt-4">Le nostre promozioni</h2>
    <div class="container d-flex justify-content-center">
        @foreach ($promotions as $promotion)
        <div class="card text-center m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">{{$promotion->name}}</h5>
              <p class="card-text">prezzo: {{$promotion->price}} €</p>
              <p class="card-text">durata in giorni: {{$promotion->time}}</p>
              {{-- <a href="#" class="btn btn-primary">Vai al pagamento</a> --}}
              <p class="d-flex align-items-center">
                <input type="hidden" name="{{$apartment->id}}" />
                <input class="form-check-input mt-0" type="checkbox" value="{{$promotion->id}}" aria-label="Checkbox for following text input">
               <span>seleziona sponsorizzazione</span>
              </p>
            </div>
          </div>
        @endforeach

    </div>

<div class="container">
  <div id="dropin-container"></div>
  <button  id="submit-button" class="button button--small button--green">Paga</button>
</div>

</form>
@endsection
