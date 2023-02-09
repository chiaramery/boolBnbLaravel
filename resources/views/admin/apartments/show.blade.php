@extends('layouts.admin')

@section('content')
<div class="container">

    <a href="{{route('admin.apartments.index')}}" class="btn btn-secondary mt-3"><i class="fa-solid fa-arrow-left"></i></a>
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
            <td>{{$apartment->title}}</td>
            <td>{{$apartment->rooms}}</td>
            <td>{{$apartment->beds}}</td>
            <td>{{$apartment->bathrooms}}</td>
            <td>{{$apartment->square_meters}}</td>
            <td>{{$apartment->address}}</td>
            <td>{{ $owner->name}}</td>
          </tr>
        </tbody>
      </table>

      <div class="slider">
        <h4>Immagini:</h4>
       <img src="{{asset('storage/'.$apartment->image)}}" alt="">
      </div>

</div>
@endsection