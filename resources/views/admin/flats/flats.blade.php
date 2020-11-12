
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                   Ciao {{ Auth::user()->name }}
                   <a class="card-link" href="#ex2" rel="modal:open"><button type="button" class="btn btn-success">Aggiungi un'appartamento</button></a>
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
                          <a href="{{route('admin.flats.show', $flat->id)}}" class="card-link">Visualizza nel dettaglio</a>
                          <a class="card-link" href="#ex1" rel="modal:open"><button type="button" class="btn btn-success">Modifica</button></a>
                        </div>
                    </div>

                    <div id="ex1" class="modal">
                        
                        <div>Modifica appartamento</div>
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
                            <a href="#" rel="modal:close">Close</a>
                    </div>


                    <div id="ex2" class="modal">

                        <div>Aggiunta appartamento</div>
                        
                        <form action="{{ route('admin.flats.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
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
                            <a href="#" rel="modal:close">Close</a>
                    </div>
                    
                </div> <!-- Chiusura padre contenitore foreach -->

                
                    

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

<script>
     $("#sticky").modal({
  escapeClose: false,
  clickClose: false,
  showClose: false
});
</script>
@endsection