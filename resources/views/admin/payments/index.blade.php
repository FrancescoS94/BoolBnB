{{-- VISUALIZZI TUTTI I PAGAMENTI DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')
@section('content')
    <div class="container">
        <h1>Tutti i pagamenti effettuati</h1>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Data pagamento</th>
                    <th scope="col">Appartamento</th>
                    <th scope="col">Durata sponsorizzazione</th>
                    <th scope="col">Fine sponsorizzazione</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ Carbon\Carbon::parse($payment['created_at'])->settings(['toStringFormat' => 'j F Y', ]) }}</td>
                    <td>{{ $payment['flat_id'] }}</td>
                    <td>{{$payment->rate->hours}} ore</td>
                    <td>{{ Carbon\Carbon::parse($payment['end_rate'])->settings(['toStringFormat' => 'j F Y \a\l\l\e h:i:s', ]) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
