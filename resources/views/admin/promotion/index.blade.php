@extends('layouts.admin')

@section('content')
    <h2 class="text-center mt-4">Le nostre promozioni</h2>
    <div class="container d-flex justify-content-center">
        @foreach ($promotions as $promotion)
        <div class="card text-center m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">{{$promotion->name}}</h5>
              <p class="card-text">prezzo: {{$promotion->price}} €</p>
              <p class="card-text">durata in giorni: {{$promotion->time}}</p>
              <a href="#" class="btn btn-primary">Vai al pagamento</a>
            </div>
          </div>
        @endforeach

    </div>
@endsection
