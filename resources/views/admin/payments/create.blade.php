@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Sponsorizza l'appartamento {{$flat->id}}</h1>

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
        
        <div >
            <h2>Dove si trova l'appartamento che vuoi inserire?</h2>
            
            {{-- form creazione indirizzo, punta al controller Admin/AddressController  --}}
            <form action="{{ route('admin.addresses.store') }}" method="post">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="country">Nazione</label>
                    <input id="country" type="text" class="form-control" name="country" id="country">
                </div>

                <div class="form-group">
                    <label for="city">Città</label>
                    <input id="city" type="text" class="form-control" name="city" id="city">
                </div>

                <div class="form-group">
                    <label for="address">Indirizzo</label>
                    <input id="address" type="text" class="form-control" name="address" id="address">
                </div>
                
                <div class="form-group">
                    <label for="cap">CAP</label>
                    <input id="cap" type="text" class="form-control" name="cap" id="cap">
                </div>
                
                <div class="form-group">
                    <label for="district">Provincia</label>
                    <input id="district" type="text" class="form-control" name="district" id="district">
                </div>
        
                <button type="submit" class="btn btn-primary">Registra l'indirizzo dell'appartamento</button>
            </form>
        </div>
    </div>
@endsection