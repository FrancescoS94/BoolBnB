{{-- VISUALIZZI TUTTI I PAGAMENTI DELL'UTENTE LOGGATO --}}
@extends('layouts.app')
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
                    <td>{{ $payment['created_at'] }}</td>
                    <td>{{ $payment['flat_id'] }}</td>
                    <td>
                        @if($payment['rate_id'] == 1)
                            {{$payment['created_at']->addHours(24)}}
                        @elseif($payment['rate_id'] == 2)
                            {{$payment['created_at']->addHours(72)}}
                        @elseif($payment['rate_id'] == 3)
                            {{$payment['created_at']->addHours(144)}}
                        @endif
                    </td>
                    <td>{{ $payment['end_rate'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection