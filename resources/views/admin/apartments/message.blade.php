@extends('layouts.admin')

@section('content')
    <h1 class="text-center">Messaggi ricevuti</h1>

    <div class="container d-flex">
        @foreach ($leads as $lead)
            <div class="card me-3 mt-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $lead->name }}</h5>
                    <p class="card-text"> Messaggio : {{ $lead->message }}</p>
                    <p class="card-text">Email : {{ $lead->email }}</p>
                    <p class="card-text">Scritto il : {{ $lead->created_at }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
