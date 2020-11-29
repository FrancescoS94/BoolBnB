{{-- TUTTI I MESSAGGI RICEVUTI DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')
@section('content')
  {{-- <div class="container vh">
    <h1>Tutti i messaggi ricevuti</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Data e ora di ricezione</th>
          <th scope="col">Nome</th>
          <th scope="col">Cognome</th>
          <th scope="col">Email</th>
          <th scope="col">Appartamento</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
          @foreach($messagesReceived as $message)
          <tr
          @if($message['viewed'] == 0)
            class="font-weight-bold"
          @endif
          >
            <td>{{ Carbon\Carbon::parse($message['created_at'])->settings(['toStringFormat' => 'j F Y \a\l\l\e h:i:s', ]) }}</td>
            <td>{{ $message['name'] }}</td>
            <td>{{ $message['lastname'] }}</td>
            <td>{{ $message['email'] }}</td>
            <td>{{ $message['flat_id'] }}</td>
            <td class="align-middle">
              <a href="{{ route('admin.messages.show', $message['id']) }}" class="btn-red">Leggi messaggio</a>
            </td>
            <td class="align-middle">
                <form action="{{ route('admin.messages.destroy', $message['id']) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input class="btn-red" type="submit" value="Cancella messaggio">
                </form>
            </td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div> --}}



<div class="jumbotron lista-messaggi">
  <h1>MESSAGGI RICEVUTI</h1>

  @foreach($messagesReceived as $message)
  <div class="row d-flex justify-content-center dettagli-messaggio
  @if($message['viewed'] == 0)
  font-weight-bold
  @endif
  ">

    <div class="col-md-4 col-lg-4 col-xl-4  left-dettagli">
      <p><strong>Data di ricezione: </strong> {{ Carbon\Carbon::parse($message['created_at'])->settings(['toStringFormat' => 'j F Y \a\l\l\e h:i:s', ]) }}</p>
      <p><strong>Da: </strong> {{ $message['name'] }} {{ $message['lastname'] }}</p>
    </div>

    <div class="col-md-4 col-lg-4 col-xl-4 center-dettagli">
      <p><strong>Appartamento: </strong>{{ $message['flat_id'] }}</p>
      <p><strong>Mail: </strong> {{ $message['email'] }}</p>
    </div>

    <div class="col-md-4 col-lg-4 col-xl-4 my-auto  buttons-dettagli">
      <span>
        <a href="{{ route('admin.messages.show', $message['id']) }}"><button class="btn-blu" type="button" name="button">Leggi</button> </a>
      </span>
      <span>
        <form action="{{ route('admin.messages.destroy', $message['id']) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn-red" type="submit" name="button">Cancella</button>
        </form>
      </span>
    </div>

  </div>  {{--chiusura row dettagli-messaggio--}}
  @endforeach

</div>  {{--chiusura container-fluid lista-messaggi --}}

@endsection
