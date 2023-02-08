@extends('layouts.admin')

@section('content')
    <h3>Lista appartamenti</h3>
      @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
      @endif
    @foreach ($apartments as $apartment)

    <div class="card" style="width: 18rem;">
        <img src="{{asset('storage/'.$apartment->image)}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$apartment->title}}</h5>
          <a href="#" class="btn btn-primary">Maggiori dettagli</a>
          <a href="" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
          <!-- Button trigger modal --> 
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
    @endforeach
@endsection