@extends('layouts.admin')

@section('content')
    <h2 class="text-center mt-5">Stai modificando: {{ $apartment->title }}</h2>
    <div class="container col-9 mt-5">

        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.apartments.update', $apartment->slug) }}">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Modifica il titolo</label>
                <input name="title" type="text" class="form-control  @error('title') is-invalid @enderror" id="title"
                    aria-describedby="title" value="{{ old('title', $apartment->title) }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">Modifica le stanze</label>
                <input name="rooms" type="number" class="form-control  @error('rooms') is-invalid @enderror"
                    id="rooms" value="{{ old('rooms', $apartment->rooms) }}">
                @error('rooms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">Modifica il numero dei letti</label>
                <input name="beds" type="number" class="form-control  @error('beds') is-invalid @enderror"
                    id="beds" value="{{ old('beds', $apartment->beds) }}">
                @error('beds')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label">Modifica il numero dei bagni</label>
                <input name="bathrooms" type="number" class="form-control  @error('bathrooms') is-invalid @enderror"
                    id="bathrooms" value="{{ old('bathrooms', $apartment->bathrooms) }}">
                @error('bathrooms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">Modifica il numero dei metri quadri</label>
                <input name="square_meters" type="number"
                    class="form-control  @error('square_meters') is-invalid @enderror" id="square_meters"
                    value="{{ old('square_meters', $apartment->square_meters) }}">
                @error('square_meters')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Modifica l'indirizzo</label>
                <input name="address" type="text" class="form-control  @error('address') is-invalid @enderror"
                    id="address" value="{{ old('address', $apartment->address) }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Modifica l'immagine</label>
                <input name="image" type="file" class="form-control  @error('image') is-invalid @enderror "
                    id="image" value="{{ old('image', $apartment->image) }}">
                {{-- Preview dell'immagine --}}
                <div class="preview-edit mt-3">
                    <img style="width: 18rem;" id="image_preview" src="{{ asset('storage/' . $apartment->image) }}"
                        alt="{{ 'Cover' . $apartment->title }}">
                </div>
            </div>



            <div class="mb-3 form-check">
                <input name="visibility" type="hidden" value="0">
                <input name="visibility" type="checkbox" @checked(old('visibility', $apartment->visibility)) class="form-check-input"
                    id="visibility" value="1">
                <label class="form-check-label" for="visibility">Visibile</label>
            </div>




            {{-- form per i servizi --}}
            <div class="form-group mb-3">
                <h4>Servizi</h4>
                @if ($errors->has('services'))
                    <span class="help-block">
                        <p style="color:red">{{ $errors->first('services') }}</p>
                    </span>
                @endif
                @foreach ($services as $service)
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="services[]" id="service-{{ $service->id }}" class="form-check-input"
                            value="{{ $service->id }}" @checked($apartment->services->contains($service))>
                        <label for="service-{{ $service->id }}" class="form-check-label">{{ $service->name }}</label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
@endsection
