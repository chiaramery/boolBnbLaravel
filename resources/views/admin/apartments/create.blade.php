@extends('layouts.admin')

@section('content')
<div class="container col-9 mt-5">
  <h3 class="text-center mt-3 mb-3">Crea un nuovo appartamento:</h3>
    <form method="post" enctype="multipart/form-data" action="{{route('admin.apartments.store')}}">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="title" value="{{old('title')}}">
          @error('title')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>
    
        <div class="mb-3">
          <label for="rooms" class="form-label">Stanze</label>
          <input name="rooms" type="number" class="form-control @error('rooms') is-invalid @enderror" id="rooms" value="{{old('rooms')}}">
          @error('rooms')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>
    
        <div class="mb-3">
            <label for="beds" class="form-label">Letti</label>
            <input name="beds" type="number" class="form-control @error('rooms') is-invalid @enderror" id="beds" value="{{old('beds')}}">
            @error('beds')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
          </div>
    
          <div class="mb-3">
            <label for="bathrooms" class="form-label">Bagni</label>
            <input name="bathrooms" type="number" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms" value="{{old('bathrooms')}}">
            @error('bathrooms')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
          </div>
    
            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri quadri</label>
                <input name="square_meters" type="number" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters" value="{{old('square_meters')}}">
                @error('square_meters')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
            </div>
    
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" value="{{old('address')}}">
                @error('address')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
            </div>
    
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input name="image" type="file" class="form-control @error('image') is-invalid @enderror" id="image" value="{{old('image')}}">
              @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
              </div>
    
              <div class="mb-3">
                <label for="longitude" class="form-label">Longitudine</label>
                <input name="longitude" type="number" class="form-control" id="longitude">
            </div>
    
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitudine</label>
                <input name="latitude" type="number" class="form-control" id="latitude">
            </div>

        <div class="mb-3 form-check">
          <input name="visibility" type="checkbox" class="form-check-input" id="visibility" value="1" checked>
          <label class="form-check-label" for="visibility">Visibile</label>
      </div>

        <h3>Servizi:</h3>
          @foreach ($services as $service)
                    <div class="mb-3 form-check">
                        <input class="form-check-input" id="service-{{ $service->id }}" name="services[]" type="checkbox"
                            value="{{ $service->id }}" @checked(in_array($service->id , old('services', [])))>
                        <label for="service-{{ $service->id }}" class="form-check-label">{{ $service->name }}</label>
                    </div>
                @endforeach


        <button type="submit" class="btn btn-primary">Crea</button>
      </form>
</div>
@endsection