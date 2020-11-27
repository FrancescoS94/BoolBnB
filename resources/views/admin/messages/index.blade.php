
{{-- TUTTI I MESSAGGI RICEVUTI DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')@section('content')<div class="container vh">
  <h1>Tutti i messaggi ricevuti</h1>  <table class="table">
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
            <a href="{{ route('admin.messages.show', $message['id']) }}" class="btn btn-dark">Leggi messaggio</a>
          </td>
          <td class="align-middle">
              <form action="{{ route('admin.messages.destroy', $message['id']) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <input class="btn btn-dark" type="submit" value="Cancella messaggio">
              </form>
          </td>
        </tr>
        @endforeach    </tbody>
  </table>  </div>
@endsection
