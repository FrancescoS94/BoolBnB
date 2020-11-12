@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Tutti i messaggi ricevuti</h1>

  @if(session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Cognome</th>
        <th scope="col">Email</th>
        <th scope="col">Appartamento</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($messages as $message)
      <tr>
        <td>{{ $message['name'] }}</td>
        <td>{{ $message['lastname'] }}</td>
        <td>{{ $message['email'] }}</td>
        <td>{{ $message['flat_id'] }}</td>
        <td class="align-middle">
          <a href="{{ route('admin.messages.show', $message['id']) }}" class="btn btn-dark">Leggi messaggio</a>
        </td>
        <td>Segna come letto</td>
        <td>Elimina</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $messages->links() }}
</div>
@endsection