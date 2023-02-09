@extends('layouts.admin')

@section('content')
<div class="content-admin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-header">{{ ("Ciao, hai effettuato l'accesso correttamente!") }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3> Nome : {{ Auth::user()->name }}</h3>
                        <h3> Cognome : {{ Auth::user()->lastname }}</h3>
                        <h3> Data di nascita : {{ Auth::user()->date_of_birth }}</h3>
    
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection