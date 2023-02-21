@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3 class="mt-3 text-uppercase fs-2 text-center text-md-start fw-bold">Lista dei tuoi appartamenti</h3>
        <div class="filter">
            <form class="mb-3 mt-4 col-5 mx-auto mx-md-0" action="{{ route('admin.apartments.index') }}" method="GET">
                @csrf
                <input type="text" class="form-control" name="search_key_title" placeholder="Cerca per titolo">
                <button class="btn btn-primary mt-2" type="submit">Cerca</button>

            </form>

        </div>
        @if (session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif
        <div class="row gy-4 justify-content-center justify-content-md-start mt-4">
            @foreach ($apartments as $apartment)
                <div class="col-8 col-md-4 col-lg-3">
                    <div class="index-card">
                        <div class="img-index">
                            <img src="{{ asset('storage/' . $apartment->image) }}" alt="">
                        </div>
                        <div class="text">
                            <h4 class="title-apartment">{{ $apartment->title }}</h4>
                            @if ($apartment->promotions()->where('is_active', 1)->exists())
                                <div class="text-center">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <span class="text-warning fw-bold">Sponsor</span>
                                </div>
                            @endif
                            <p class="title-address">{{ $apartment->address }}</p>
                        </div>
                        <div class="actions">
                            <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.apartments.edit', $apartment->slug) }}" class="btn btn-warning"><i
                                    class="fa-solid fa-pen"></i></a>
                            {{-- Promozioni --}}


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
    @endsection
