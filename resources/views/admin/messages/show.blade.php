{{-- SHOW DEL SINGOLO MESSAGGIO DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')

@section('content')

<div class="container show-messaggio">

  <div class="row messaggio d-flex justify-content-center">
    <div class="jumbotron col-md-10 col-lg-10 col-xl-10 ">

      <div class="row titolo-messaggio">
        <h1>Messaggio ricevuto</h1>
      </div>

      <div class="row">
        <div class="dettagli">
          <ul>
            <li> <strong>Data e ora di ricezione</strong> {{ Carbon\Carbon::parse($message['created_at'])->settings(['toStringFormat' => 'j F Y \a\l\l\e h:i:s', ]) }}</li>
            <li> <strong>Nome</strong> {{ $message['name'] }}</li>
            <li> <strong>Cognome</strong> {{ $message['lastname'] }}</li>
            <li> <strong>Email</strong> {{ $message['email'] }}</li>
            <li> <strong>Appartamento</strong> {{ $message['flat_id'] }}</li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="testo-messaggio">
          <p>{{ $message['request'] }}</p>
        </div>
      </div>


        <div class="lettura row">
          @if($message['viewed'] == 0)
            <form action="{{ route('admin.messages.update', $message['id']) }}" method="post">
                @csrf
                @method('PATCH')
                <input class="btn-blu" type="submit" value="Segna come letto">
            </form>

          @else
            <form action="{{ route('admin.messages.update', $message['id']) }}" method="post">
                @csrf
                @method('PATCH')
                <input class="btn-blu" type="submit" value="Segna come da leggere">
            </form>

          @endif
            <form action="{{ route('admin.messages.destroy', $message['id']) }}" method="post">
                @csrf
                @method('DELETE')
                <input class="btn-red" type="submit" value="Cancella messaggio">
            </form>
        </div>



    </div>   {{-- fine Jumbo --}}

  </div>

</div>


@endsection
