@extends('layouts.admin')
@push('scripts')
    <script src="{{ asset('js/address-autocomplete.js') }}"></script>
@endpush
@section('content')
    <div class="container col-9 mt-5">
        <h3 class="text-center mt-3 mb-3">Crea un nuovo appartamento:</h3>
        <form method="post" enctype="multipart/form-data" action="{{ route('admin.apartments.store') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input required name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                    id="title" aria-describedby="title" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">Stanze</label>
                <input required name="rooms" type="number" min="1"
                    class="form-control @error('rooms') is-invalid @enderror" id="rooms" value="{{ old('rooms') }}">
                @error('rooms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">Letti</label>
                <input required name="beds" type="number" min="1"
                    class="form-control @error('rooms') is-invalid @enderror" id="beds" value="{{ old('beds') }}">
                @error('beds')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bagni</label>
                <input required name="bathrooms" type="number" min="1"
                    class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms"
                    value="{{ old('bathrooms') }}">
                @error('bathrooms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri quadri</label>
                <input required name="square_meters" type="number" min="1"
                    class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
                    value="{{ old('square_meters') }}">
                @error('square_meters')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>




            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input required name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                    id="address" value="{{ old('address') }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <script>
                const searchBox = tomtom.services.fuzzySearch({
                    key: 'upEwnVbILIY3XpQgAsiO3mhPUP6dQdCd',
                    limit: 5
                });

                const input = document.getElementById('address');

                input.addEventListener('input', function() {
                    searchBox.query(input.value).go(function(results) {
                        console.log(results);
                        // Aggiungi il codice per popolare le opzioni di suggerimento qui
                    });
                });
            </script>

            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input required name="image" type="file" class="form-control @error('image') is-invalid @enderror"
                    id="image" value="{{ old('image') }}">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>



            <div class="mb-3 form-check">
                <input name="visibility" type="checkbox" class="form-check-input" id="visibility" value="1" checked>
                <label class="form-check-label" for="visibility">Visibile</label>
            </div>




            <h3>Servizi:</h3>
            <div>
                @if ($errors->has('services'))
                    <span class="help-block">
                        <p style="color:red">{{ $errors->first('services') }}</p>
                    </span>
                @endif
                @foreach ($services as $service)
                    <div class="mb-3 form-check form-check-inline {{ $errors->has('services') ? 'has-error' : '' }}">
                        <label for="service-{{ $service->id }}" class="form-check-label">{{ $service->name }}</label>
                        <input class="form-check-input" id="service-{{ $service->id }}" name="services[]" type="checkbox"
                            value="{{ $service->id }}" @checked(in_array($service->id, old('services', [])))>
                    </div>
                @endforeach


            </div>

            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </div>
@endsection
