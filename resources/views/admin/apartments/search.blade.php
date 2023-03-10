@extends('layouts.admin')

@section('content')
    <form class="mt-5 col-8 m-auto" action="{{ route('admin.search') }}" method="GET">
        <div class="form-group">
            <label for="title">Titolo :</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="address">Indirizzo</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>
        <div class="form-group">
            <label for="rooms">Numero di camere:</label>
            <input type="number" name="rooms" id="rooms" class="form-control">
        </div>
        <div class="form-group">
            <label for="beds">Posti letto :</label>
            <input type="number" name="beds" id="beds" class="form-control">
        </div>

        <button type="submit" class="mb-3 btn btn-primary mt-3">Cerca</button>
    </form>
    <div class="container mt-2">
        <div class="row gy-4 justify-content-center justify-content-md-start mt-4">
            @foreach ($apartments as $apartment)
                <div class="col-8 col-md-4 col-lg-3">
                    <div class="index-card">
                        <div class="img-index">
                            <img src="{{ asset('storage/' . $apartment->image) }}" alt="">
                        </div>
                        <div class="text">
                            <h4 class="title-apartment">{{ $apartment->title }}</h4>
                            <p class="title-address">{{ $apartment->address }}</p>
                        </div>
                        <div class="actions">
                            <a href="{{ route('admin.apartments.show', $apartment->slug) }}"
                                class="btn btn-success">View</a>
                            <a href="{{ route('admin.apartments.edit', $apartment->slug) }}" class="btn btn-warning"><i
                                    class="fa-solid fa-pen"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#delete-apartment-{{ $apartment->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
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
            @endforeach
        </div>
    </div>
@endsection
