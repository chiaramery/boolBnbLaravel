@extends('layouts.admin')

@section('content')
    <h3 class="text-center mt-3 mb-3">Lista appartamenti:</h3>
    <div class="filter d-flex justify-content-around">
        <form class="mb-4 col-5 m-auto d-flex " action="{{ route('admin.apartments.index') }}" method="GET">
            @csrf
            <input type="text" class="form-control me-3 " name="search_key_title" placeholder="Cerca per titolo">
            <button class="btn btn-primary me-4" type="submit">Cerca</button>
            <a class="btn btn-primary col-3" href="{{ route('admin.search') }}">
                Ricerca avanzata
            </a>
        </form>

    </div>

    <div class="row">

        @if (session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif

        @foreach ($apartments as $apartment)
            <div class="col-3">
                <div class="card mb-3 col-2" style="width: 18rem;">
                    <img src="{{ asset('storage/' . $apartment->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $apartment->title }}</h5>
                        <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="btn btn-primary">Maggiori
                            dettagli</a>
                        <a href="{{ route('admin.apartments.edit', $apartment->slug) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-apartment-{{ $apartment->id }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <!-- Modal della conferma prima della cancellazione -->
                        <div class="modal fade" id="delete-apartment-{{ $apartment->id }}" tabindex="-1"
                            aria-labelledby="delete-label-{{ $apartment->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="delete-label-{{ $apartment->id }}">Vuoi
                                            cancellare {{ $apartment->title }}?</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Annulla</button>
                                        <form action="{{ route('admin.apartments.destroy', $apartment->slug) }}"
                                            method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">
                                                Elimina
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
@endsection
