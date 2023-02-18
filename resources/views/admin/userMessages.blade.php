@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>Messaggi ricevuti</h1>
        <h3>Mittente:</h3>
        <p>{{ $userMessages->name }}</p>

        <h3>Mail:</h3>
        <p>mail</p>

        <h3>Messaggio:</h3>
        <p></p>

    </div>
@endsection
