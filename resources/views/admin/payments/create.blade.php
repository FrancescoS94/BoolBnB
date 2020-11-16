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
        
        <p>Puoi sponsorizzare l'appartamento {{ $flat->title}} per 1, 3 o 6 giorni.</p>
        <p>Il tuo appartamento verrà mostrato in home page e nella pagina di ricerca, in evidenza rispetto agli altri appartamenti, per l'intera durata della sponsorizzazione.</p>
        
        {{-- form per la sponsorizzazione dell'appartamento, punta al controller Admin/PaymentController  --}}
        <form action="{{ route('admin.payments.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="end_rate">Scegli la tua sponsorizzazione</label>
                <input id="end_rate" type="text" class="form-control" name="end_rate">
            </div>
    
            <button type="submit" class="btn btn-primary">Sponsorizza l'appartamento</button>
        </form>
    </div>
@endsection