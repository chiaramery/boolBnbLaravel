@extends('layouts.admin')

@section('content')
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
    <form method="POST" enctype="multipart/form-data" action="{{route('admin.apartments.store')}}">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input name="title" type="text" class="form-control" id="title" aria-describedby="title">
        </div>
    
        <div class="mb-3">
          <label for="rooms" class="form-label">Stanze</label>
          <input name="rooms" type="number" class="form-control" id="rooms">
        </div>
    
        <div class="mb-3">
            <label for="beds" class="form-label">Letti</label>
            <input name="beds" type="number" class="form-control" id="beds">
          </div>
    
          <div class="mb-3">
            <label for="bathrooms" class="form-label">Bagni</label>
            <input name="bathrooms" type="number" class="form-control" id="bathrooms">
          </div>
    
            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri quadri</label>
                <input name="square_meters" type="number" class="form-control" id="square_meters">
            </div>
    
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input name="address" type="text" class="form-control" id="address">
            </div>
    
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input name="image" type="file" class="form-control" id="image">
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
          <input name="visibility" type="checkbox" class="form-check-input" id="visibility" value="1">
          <label class="form-check-label" for="visibility">visibile</label>
        </div>

        <div class="mb-3 form-check">
          <input name="visibility" type="checkbox" class="form-check-input" id="visibility" value="0">
          <label class="form-check-label" for="visibility">Non visibile</label>
        </div>

        <button type="submit" class="btn btn-primary">Crea</button>
      </form>
</div>
@endsection