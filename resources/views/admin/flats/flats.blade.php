{{-- APPARTAMENTI INSERITI DELL'UTENTE LOGGATO --}}
@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-body">
                   Ciao {{ Auth::user()->name }}
                    <a href="{{ route('admin.flats.create') }}" class="card-link"><button type="button" class="btn btn-success">Aggiungi un'appartamento</button></a>
                </div>

                {{-- validazione campi  --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- esito dell'operazione  --}}
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>  
                @endif


                        
                        
                
                <div>
                    {{-- ciclo i valori che ritornano dal controller con il compact! mostro tutti gli appartamenti dell'utente loggato --}} 
                    @foreach ($flats as $flat)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">{{$flat->title}}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">{{$flat->created_at}}</h6>
                          <p class="card-text">{{$flat->description}}</p>
                          <p class="card-text">{{$flat->bed}}</p>
                          <p class="card-text">{{$flat->room}}</p>
                          <p class="card-text">{{$flat->wc}}</p>
                          <p class="card-text">{{$flat->mq}}</p>
                        <img src="{{asset('storage/'. $flat->image)}}" alt="{{$flat->title}}">
                        <a href="{{route('admin.flats.edit', $flat->id)}}" class="card-link">Modifica appartamento</a>
                        </div>
                    </div>
                    
                
                        

                    {{-- distruggi l'appartamento, attraverso l'id --}}
                    <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancella questo appartamento</button>
                    </form>
                    @endforeach  
                </div> <!-- Chiusura padre contenitore foreach -->

                
                    


                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

<script>
     /* $("#sticky").modal({
  escapeClose: false,
  clickClose: false,
  showClose: false
}); */
</script> --}}
@endsection