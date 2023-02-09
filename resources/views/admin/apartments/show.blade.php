@extends('layouts.admin')

@section('content')
<div class="container">

    <a href="{{route('admin.apartments.index')}}" class="btn btn-secondary mt-3"><i class="fa-solid fa-arrow-left"></i></a>
      <h3 class="text-center mb-3">Maggiori dettagli:</h3>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Stanze</th>
            <th scope="col">Letti</th>
            <th scope="col">Bagni</th>
            <th scope="col">Metri Quadri</th>
            <th scope="col">Indirizzo</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$apartment->rooms}}</td>
            <td>{{$apartment->beds}}</td>
            <td>{{$apartment->bathrooms}}</td>
            <td>{{$apartment->square_meters}}</td>
            <td>{{$apartment->address}}</td>
          </tr>
        </tbody>
      </table>

      <div class="slider">
       {{-- <img src="{{asset('storage/'.$apartment->image)}}" alt=""> --}}
      </div>

        <div class="map mt-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3224.691133877618!2d-95.90582168464977!3d36.076636980103935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8dfacfbac1c78fcf!2zMzbCsDA0JzM1LjkiTiA5NcKwNTQnMTMuMSJX!5e0!3m2!1sit!2sit!4v1675934589292!5m2!1sit!2sit" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
</div>
@endsection