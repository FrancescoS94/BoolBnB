{{-- SHOW DEL SINGOLO MESSAGGIO DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')

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
    @if($message['viewed'] == 0)
      <form action="{{ route('admin.messages.update', $message['id']) }}" method="post">
          @csrf
          @method('PATCH')
          <input class="btn btn-dark" type="submit" value="Segna come letto">
      </form>
      @else
      <form action="{{ route('admin.messages.update', $message['id']) }}" method="post">
          @csrf
          @method('PATCH')
          <input class="btn btn-dark" type="submit" value="Segna come da leggere">
      </form>
    @endif
    <form action="{{ route('admin.messages.destroy', $message['id']) }}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-dark" type="submit" value="Cancella messaggio">
    </form>
  </div>
</div>
@endsection
