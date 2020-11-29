{{-- @dd(count($flatsUser), $flatsUser) --}}
{{-- APPARTAMENTI INSERITI DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')

@section('aside')
    {{-- Sidebar --}}
      <div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2 aside">

        {{-- Nome e immagine Avatar --}}
        <div class="utente-dash text-center">
          <div class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              @if(Auth::check())
                  <img id="avatar-img" class="rounded-circle" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. Auth::user()->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo">
                  <p id="name"> {{Auth::user()->name}}</p>
              @endif
          </div>
        </div>

        {{-- Link Sidebar--}}
        <div class="links-box">

            <a href="{{ route('home') }}"> <span><i class="fas fa-home"></i></span><span class="link-name">Homepage</span></a>

            <a href="{{ route('admin.users.index') }}"> <span><i class="fas fa-users-cog"></i></span><span class="link-name">Profilo</span></a>

            <a href="{{ route('admin.flats.index') }}"><span><i class="fas fa-house-user"></i></span><span class="link-name">Appartamenti</span></a>

            <a href="{{ route('admin.messages.index') }}"> <span><i class="fas fa-envelope"></i></span><span class="link-name">Messaggi</span></a>

            <a href="{{ route('admin.payments.index') }}"> <span><i class="fas fa-credit-card"></i></span><span class="link-name">Pagamenti</span></a>

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              <span><i class="fas fa-sign-out-alt"></i></span>
              <span class="link-name ">Logout</span>
            </a>
            {{-- chiamata post --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </div>

      </div>
@endsection


@section('content')
    <div class="container flats-list vh">
        <div class="row">
            <div class="col-12">
                {{-- <h1>Ciao {{ Auth::user()->name }}</h1> --}}
                {{-- se l'utente non ha completato la registrazione non potrà inserire appartamenti --}}
                @if(is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth ))
                    <h2 class="font-weight-bold py-3">Completa il tuo profilo prima di inserire un appartamento!</h2>
                @else
                    <h2 class="font-weight-bold py-3 pb">I tuoi appartamenti</h2>
                    {{-- il btn "aggiungi un appartamento" porta a admin.addresses.create e poi a admin.flats.create --}}
                    <a href="{{ route('admin.addresses.create') }}" class="card-link">
                        <button type="button" class="btn-blu mb-4">Aggiungi</button>
                    </a>
                    @if(count($flatsUser) == 0)
                        <p>Non hai ancora registrato nessun appartamento.</p>
                    @elseif(count($flatsUser) > 0)
                        {{-- validazione campi  --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- esito dell'operazione  --}}
                        @if(session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        {{-- ciclo i valori che ritornano dal controller con il compact! mostro tutti gli appartamenti dell'utente loggato --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="tb-none" scope="col">Title</th>
                                    <th class="tb-none" scope="col">bed</th>
                                    <th class="tb-none" scope="col">room</th>
                                    <th class="tb-none" scope="col">wc</th>
                                    <th class="tb-none" scope="col">mq</th>
                                    <th class="tb-none" scope="col">image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($flatsUser as $flat)
                                <tr>
                                    <td>{{$flat->title}}</td>
                                    <td class="tb-none">{{$flat->bed}}</td>
                                    <td class="tb-none">{{$flat->room}}</td>
                                    <td class="tb-none">{{$flat->wc}}</td>
                                    <td class="tb-none">{{$flat->mq}}</td>
                                    <td>
                                        <img class="img-fluid" src="{{url('storage/'. $flat->image)}}" alt="{{$flat->title}}">
                                    </td>
                                    </div>
                                    <td class="tb-none">
                                        <a class="btn-blu text-decoration-none" role="button" href="{{route('admin.flats.edit', $flat->id )}}">
                                            Modifica
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn-blu text-decoration-none" role="button" href="{{route('admin.flats.show', $flat->id)}}">
                                            Visualizza
                                        </a>
                                    </td>
                                    <td class="tb-none">
                                        <a class="btn-blu text-decoration-none" role="button" href="{{route('admin.payments.create', $flat->id)}}">
                                            Sponsorizza
                                        </a>
                                    </td>
                                    <td class="tb-none">{{-- elimina l'appartamento, attraverso l'id --}}
                                        <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-red">Cancella</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach <!-- Chiusura padre contenitore foreach -->
                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
