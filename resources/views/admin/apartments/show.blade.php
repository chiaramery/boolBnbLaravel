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

    {{-- Promozioni --}}
    <h2 class="text-center mt-4">Le nostre promozioni</h2>
    <div class="container">
        <form method="POST" id="payment-form" action="{{ route('admin.orders.makePayment') }}">
            @csrf
            <div class="container d-flex justify-content-center">
                @foreach ($promotions as $promotion)
                    <div class="card text-center m-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $promotion->name }}</h5>
                            <p class="card-text">prezzo: {{ $promotion->price }} €</p>
                            <p class="card-text">durata in giorni: {{ $promotion->time }}</p>
                            {{-- <a href="#" class="btn btn-primary">Vai al pagamento</a> --}}
                            <div class="d-flex align-items-center">
                                <input type="hidden" name="appartamento" value="{{ $apartment->id }}" />
                                <input class="form-check-input mt-0" type="radio" name="price"
                                    value="{{ $promotion->id }}" aria-label="Checkbox for following text input">
                                <span class="text-center">seleziona</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <section>
                {{-- <label for="amount">
                    <span class="input-label">Price:</span>
                    <div class="input-wrapper amount-wrapper">
                        <div id="amount" name="amount">
                            {{ $promotion->price }} €
                        </div>
                    </div>
                </label> --}}
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>
            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button" type="submit"><span>Test Transaction</span></button>
        </form>
        <script src="https://js.braintreegateway.com/web/dropin/1.33.7/js/dropin.min.js"></script>
        <script>
            var form = document.querySelector('#payment-form');
            var client_token = '{{ $token }}'
            braintree.dropin.create({
                    authorization: client_token,
                    selector: '#bt-dropin',

                },
                function(createErr, instance) {
                    if (createErr) {
                        console.log('Create Error', createErr);
                        return;
                    }
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();

                        instance.requestPaymentMethod(function(err, payload) {
                            if (err) {
                                console.log('Request Payment Method Error', err);
                                return;
                            }

                            // Add the nonce to the form and submit
                            document.querySelector('#nonce').value = payload.nonce;
                            form.submit();
                        });
                    });
                });
        </script>
    </div>
@endsection
