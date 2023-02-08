@extends('layouts.admin')

@section('content')
<h2 class="text-center mt-5">Stai modificando: {{$apartment->title}}</h2>
<div class="container col-9 mt-5">
    @if ($errors->any())
              <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                      <ul>
                          <li>{{ $error }}</li>
                      </ul>
                  @endforeach
              </div>
          @endif
      <form method="POST" enctype="multipart/form-data" action="{{route('admin.apartments.update', $apartment->slug)}}">
        @method('PUT')
          @csrf
          <div class="mb-3">
            <label for="title" class="form-label">Modifica il titolo</label>
            <input name="title" type="text" class="form-control" id="title" aria-describedby="title" value="{{old('title', $apartment->title)}}">
          </div>
      
          <div class="mb-3">
            <label for="rooms" class="form-label">Modifica le stanze</label>
            <input name="rooms" type="number" class="form-control" id="rooms" value="{{old('rooms', $apartment->rooms)}}">
          </div>
      
          <div class="mb-3">
              <label for="beds" class="form-label">Modifica il numero dei letti</label>
              <input name="beds" type="number" class="form-control" id="beds" value="{{old('beds', $apartment->beds)}}">
            </div>
      
            <div class="mb-3">
              <label for="bathrooms" class="form-label">Modifica il numero dei bagni</label>
              <input name="bathrooms" type="number" class="form-control" id="bathrooms" value="{{old('bathrooms', $apartment->bathrooms)}}">
            </div>
      
              <div class="mb-3">
                  <label for="square_meters" class="form-label">Modifica il numero dei metri quadri</label>
                  <input name="square_meters" type="number" class="form-control" id="square_meters" value="{{old('square_meters', $apartment->square_meters)}}">
              </div>
      
              <div class="mb-3">
                  <label for="address" class="form-label">Modifica l'indirizzo</label>
                  <input name="address" type="text" class="form-control" id="address" value="{{old('address', $apartment->address)}}">
              </div>
      
              <div class="mb-3">
                  <label for="image" class="form-label">Modifica l'immagine</label>
                  <input name="image" type="file" class="form-control" id="image" value="{{old('image', $apartment->image)}}">
                </div>
      
                <div class="mb-3">
                  <label for="longitude" class="form-label">Modifica la longitudine</label>
                  <input name="longitude" type="number" class="form-control" id="longitude" value="{{old('longitude', $apartment->longitude)}}">
              </div>
      
              <div class="mb-3">
                  <label for="latitude" class="form-label">Modifica la latitudine</label>
                  <input name="latitude" type="number" class="form-control" id="latitude" value="{{old('latitude', $apartment->latitude)}}">
              </div>
      
          <div class="mb-3 form-check">
            <input name="visibility" type="checkbox" class="form-check-input" id="visibility" value="1" @checked(old('visibility' , $apartment->visibility))>
            <label class="form-check-label" for="visibility">Visibile</label>
          </div>
  
          <div class="mb-3 form-check">
            <input name="visibility" type="checkbox" class="form-check-input" id="visibility" value="0" @checked(!old('visibility' , $apartment->visibility))>
            <label class="form-check-label" for="visibility">Non visibile</label>
          </div>
  
          {{-- form per i servizi --}}
          <div class="form-group mb-3">
            <h5>Servizi</h5>
            @foreach ($services as $service)
                <div class="form-check">
                    <input type="checkbox" name="services[]" id="service-{{ $service->id }}"
                        class="form-check-input" value="{{ $service->id }}" {{(is_array(old('services')) && in_array(1, old('services')))? 'checked' : ''}}>
                    <label for="service-{{ $service->id }}"
                        class="form-check-label">{{ $service->name }}</label>
                </div>
            @endforeach
        </div>
          <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
  </div>
@endsection