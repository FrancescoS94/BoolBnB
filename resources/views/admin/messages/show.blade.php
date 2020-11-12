@extends('layouts.app')

@section('content')
<div class="container">

  <div class="navigazione">
    <a href="{{ route('admin.messages.index') }}">Torna a tutti i messaggi</a>
  </div>

  <h1>Messaggio ricevuto</h1>
  <div class="dettagli">
    <ul>
      <li> <strong>Nome</strong> {{ $message['name'] }}</li>
      <li> <strong>Cognome</strong> {{ $message['lastname'] }}</li>
      <li> <strong>Email</strong> {{ $message['email'] }}</li>
      <li> <strong>Appartamento</strong> {{ $message['flat_id'] }}</li>
    </ul>
    <p>{{ $message['request'] }}</p>
  </div>
  <div class="lettura">
    {{-- TENTATIVO PER SOVRASCRIVERE VALORE VIEWED MA NON ENTRA IN UPDATE --}}
    @if($message['viewed'] == 0)
      <a href="{{ route('admin.messages.update', $message['id']) }}" class="btn btn-dark">Segna come letto</a>
    @else
      <a href="{{ route('admin.messages.update', $message['id']) }}" class="btn btn-dark">Segna come non letto</a>
    @endif
  </div>
</div>
@endsection