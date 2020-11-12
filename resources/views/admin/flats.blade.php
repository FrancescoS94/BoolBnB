
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                   Ciao {{ Auth::user()->name }}
                </div>
                <div>
                    @foreach ($flats as $flat)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <h6 class="card-subtitle mb-2 text-muted">{{$flat->created_at}}</h6>
                          <p class="card-text">{{$flat->description}}</p>
                          <p class="card-text">{{$flat->bed}}</p>
                          <p class="card-text">{{$flat->room}}</p>
                          <p class="card-text">{{$flat->wc}}</p>
                          <p class="card-text">{{$flat->mq}}</p>
                          <a href="#" class="card-link">Card link</a>
                          <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                    <form action="{{ route('admin.flats.update', $flat->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="room">Stanze</label>
                        <input type="text" class="form-control" name="room">
                    </div>

                    <div class="form-group">
                        <label for="bed">Letti</label>
                        <input type="text" class="form-control" name="bed">
                    </div>

                    <div class="form-group">
                        <label for="wc">WC</label>
                        <input type="text" class="form-control" name="wc">
                    </div>

                    <div class="form-group">
                        <label for="mq">Metri quadrati</label>
                        <input type="text" class="form-control" name="mq">
                    </div>

                    <div class="form-group">
                      <label for="description">Descrizione</label>
                      <input type="text" class="form-control-file" name="description">
                    </div>

                    <div class="form-group">
                        <label for="image">Inserisci una fotografia dell'appartamento</label>
                        <input type="file" class="form-control-file" name="image">
                    </div>

                    <button type="submit" class="btn btn-primary">Invia il modulo</button>
                </form>

                <form action="{{ route('admin.users.destroy', $flat->id) }}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Cancella questo appartamento</button>
                </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection