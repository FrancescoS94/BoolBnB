{{-- @dd($address, $flat); --}}
@extends('layouts.app')
@section('content')
{{-- UPDATE/MODIFICA DEGLI INDIRIZZI --}}
    <div class="container">
        <div class="row">
            <div class="col-md-8">

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

                {{-- arrivo da addressControllEdit --}}
                {{-- per ciascun appartamento posso modificare i valori grazie all'id --}}
                <div>Modifica indirizzo</div>
                {{-- <form action="{{ route('admin.addresses.update', $addresses->id)}}" method="post"> --}}
                    <form action="{{ route('admin.addresses.update', $flat->address_id )}}" method="post">
                    @csrf
                    @method('PATCH')

                    {{-- passo in un input nascosto l'id dell'address --}}
                    <input hidden type="text" class="form-control" name="address" value="{{ $flat->id }}"> 
                    
                    <div class="form-group">
                        <label for="country">Nazione</label>
                        <input id="country" type="text" class="form-control" name="country" value="{{ $flat->address->country }}">
                    </div>

                    <div class="form-group">
                        <label for="city">Città</label>
                        <input id="city" type="text" class="form-control" name="city" value="{{ $flat->address->city }}">
                    </div>

                    <div class="form-group">
                        <label for="address">Indirizzo</label>
                        <input id="address" type="text" class="form-control" name="address" value="{{ $flat->address->address }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="cap">CAP</label>
                        <input id="cap" type="text" class="form-control" name="cap" value="{{ $flat->address->cap }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="district">Provincia</label>
                        <input id="district" type="text" class="form-control" name="district" value="{{ $flat->address->district }}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Invia il modulo</button>
                </form>
            </div>
        </div>
    </div>
@endsection