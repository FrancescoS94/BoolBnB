{{-- TUTTI I MESSAGGI RICEVUTI DELL'UTENTE LOGGATO --}}
@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Aggiungi un'appartamento</h1>

                {{-- status --}}
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- controllo errori --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <div > {{-- tentativo di nascondere form indizzo quando l'indirizzo è stato creato e l'address id è passato nell'url --}}
                {{-- <div class="{{ (!empty($address->id)) ? 'd-none' : '' }}"> tentativo di nascondere form indizzo quando l'indirizzo è stato creato e l'address id è passato nell'url --}}
                    <h2>Dove si trova l'appartamento che vuoi inserire?</h2>
                    
                    {{-- form creazione indirizzo, punta al controller Admin/AddressController  --}}
                    <form action="{{ route('admin.addresses.store') }}" method="post">
                        @csrf
                        @method('POST')
    
                        <div class="form-group">
                            <label for="country">Nazione</label>
                            <input type="text" class="form-control" name="country" id="country">
                        </div>
    
                        <div class="form-group">
                            <label for="city">Città</label>
                            <input type="text" class="form-control" name="city" id="city">
                        </div>
    
                        <div class="form-group">
                            <label for="address">Indirizzo</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        
                        <div class="form-group">
                            <label for="cap">CAP</label>
                            <input type="text" class="form-control" name="cap" id="cap">
                        </div>
                        
                        <div class="form-group">
                            <label for="district">Provincia</label>
                            <input type="text" class="form-control" name="district" id="district">
                        </div>
               
                        <button type="submit" class="btn btn-primary">Registra l'indirizzo dell'appartamento</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection