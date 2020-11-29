{{-- VISUALIZZI TUTTI I PAGAMENTI DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')
@section('content')
    <div class="jumbotron lista-pagamenti">
        <h1>PAGAMENTI</h1>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @foreach($payments as $payment)
        <div class="row d-flex justify-content-center dettagli-pagamento">

          <div class="col-md-2 col-lg-2 col-xl-2 left-dettagli">
            <p> <strong>Appartamento:</strong> {{ $payment['flat_id'] }} </p>
          </div>

          <div class="col-md-3 col-lg-3 col-xl-3 left-dettagli">
            <p> <strong>Data pagamento:</strong> {{ Carbon\Carbon::parse($payment['created_at'])->settings(['toStringFormat' => 'j F Y', ]) }} </p>
          </div>

          <div class="col-md-3 col-lg-3 col-xl-3 left-dettagli">
            <p><strong>Durata sponsorizzazione:</strong> {{$payment->rate->hours}} ore</p>
          </div>

          <div class="col-md-4 col-lg-4 col-xl-4 center-dettagli">
            <p><strong>Fine sponsorizzazione:</strong> {{ Carbon\Carbon::parse($payment['end_rate'])->settings(['toStringFormat' => 'j F Y \a\l\l\e h:i:s', ]) }}</p>
          </div>

        </div>
        @endforeach










@endsection
