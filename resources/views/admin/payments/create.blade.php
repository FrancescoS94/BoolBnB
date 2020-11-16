@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Sponsorizza un appartamento</h1>

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
        
        <p>Puoi sponsorizzare un appartamento per 1, 3 o 6 giorni.</p>
        <p>Il tuo appartamento verrà mostrato in home page e nella pagina di ricerca, in evidenza rispetto agli altri appartamenti, per l'intera durata della sponsorizzazione.</p>
        
        {{-- form per la sponsorizzazione dell'appartamento, punta al controller Admin/PaymentController  --}}
        <form action="{{ route('admin.payments.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="flat_id">Scegli l'appartamento che vuoi sponsorizzare</label>
                <select class="form-control" id="flat_id" name="flat_id">
                    <option>Seleziona un appartamento</option>
                    @foreach($flats as $flat)
                    <option value="{{ $flat->id }}">{{ $flat->title }}</option>
                    {{-- <option>{{ $flat->id }}</option> --}}
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="rate_id">Scegli la tua sponsorizzazione</label>
                <select class="form-control" id="rate_id" name="rate_id">
                    <option>Seleziona una tipologia di sponsorizzazione</option>
                    <option value="1">24 ore - 1 giorno</option>
                    <option value="2">72 ore - 3 giorni</option>
                    <option value="3">144 ore - 6 giorni</option>
                </select>

            </div>
    
            <button type="submit" class="btn btn-primary">Sponsorizza l'appartamento</button>
        </form>
    </div>
@endsection