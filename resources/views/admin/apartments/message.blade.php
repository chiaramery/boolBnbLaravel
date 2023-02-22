@extends('layouts.admin')

@section('content')
    <h1 class="text-center  mt-4">Messaggi ricevuti</h1>
    <div class="container d-flex justify-content-center justify-content-md-start flex-wrap">
        @foreach ($leads as $lead)
            <div class="card me-3 mt-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $lead->name }}</h5>
                    <p class="card-text"> <span class="fw-bold">Messaggio : </span> {{ $lead->message }}</p>
                    <p class="card-text"><span class="fw-bold">Email :</span> {{ $lead->email }}</p>
                    <p class="card-text"><span class="fw-bold">Scritto il :</span>
                        {{ $lead->created_at->setTimezone('Europe/Rome')->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
