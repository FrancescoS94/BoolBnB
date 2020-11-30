@extends('layouts.admin')

@section('head')
  {{-- SCRIPT BRAINTREE --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>
@endsection

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

    <div class="container vh update">
        <div class="row d-flex justify-content-center pt-5">
            <div class="col-md-10 col-lg-9 jumbotron">
                <h2 class="font-weight-bold d-flex justify-content-center pb-4">Sponsorizza un appartamento</h2>
                {{-- inserire costi sponsorizzazioni --}}
                <div class="row">
                    <div class="col-4 d-flex justify-content-center">
                        <div class="flex-column">
                            <p class="cb">1 giorno:</p>
                            <span class="silver">€ 2.99</span>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <div class="flex-column">
                            <p class="cb">3 giorni:</p>
                            <span class="gold">€ 5.99</span>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <div class="flex-column">
                            <p class="cb">6 giorni:</p>
                            <span class="platinum">€ 9.99</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center pt-4">
                        <p class="col-12 col-md-10 col-lg-8">Il tuo appartamento verrà mostrato in home page e nella pagina di ricerca, in evidenza rispetto agli altri appartamenti, per l'intera durata della sponsorizzazione.</p>
                    </div>
                </div>
                
                {{-- HOSTED FORM BRAINTREE --}}
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="spacer"></div>

                        @if (session()->has('success_message'))
                            <div class="alert alert-success">
                                {{ session()->get('success_message') }}
                            </div>
                        @endif

                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="payment" action="{{ route('admin.payments.store') }}" method="POST" id="payment-form">
                            @csrf

                            <div class="form-group">
                                <label for="flat_id">Scegli l'appartamento:</label>
                                <select class="form-control" id="flat_id" name="flat_id">
                                    <option value="">Seleziona un appartamento</option>
                                    @foreach($flats as $flat)
                                    <option value="{{ $flat->id }}">{{ $flat->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="rate_id">Scegli la tua sponsorizzazione:</label>
                                <select class="form-control" id="rate_id" name="rate_id">
                                    <option value="">Seleziona una tipologia di sponsorizzazione</option>
                                    <option value="1">24 ore - 1 giorno</option>
                                    <option value="2">72 ore - 3 giorni</option>
                                    <option value="3">144 ore - 6 giorni</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <label for="cc_number">Carta di credito</label>

                                    <div class="form-group" id="card-number">

                                    </div>
                                </div>

                                <div class="col-8 col-md-8 col-lg-3">
                                    <label for="expiry">Scadenza</label>

                                    <div class="form-group" id="expiration-date">

                                    </div>
                                </div>

                                <div class="col-4 col-md-4 col-lg-3">
                                    <label for="cvv">CVV</label>

                                    <div class="form-group" id="cvv">

                                    </div>
                                </div>

                            </div>

                            <div class="spacer"></div>

                            <div id="paypal-button"></div>

                            <div class="spacer"></div>

                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                            {{-- <button type="submit" class="btn-blu">Paga adesso</button> --}}
                            <input type="submit" class="btn-blu" value="Paga adesso">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      var form = document.querySelector('#payment-form');
    var submit = document.querySelector('input[type="submit"]');

    braintree.client.create({
        authorization: '{{ $token }}'
    }, function (clientErr, clientInstance) {
        if (clientErr) {
            console.error(clientErr);
            return;
        }

    // This example shows Hosted Fields, but you can also use this
    // client instance to create additional components here, such as
    // PayPal or Data Collector.

    braintree.hostedFields.create({
        client: clientInstance,
        styles: {
            'input': {
                'font-size': '14px'
            },
            'input.invalid': {
                'color': 'red'
            },
            'input.valid': {
                'color': 'green'
            }
        },
        fields: {
            number: {
                selector: '#card-number',
                placeholder: '4111 1111 1111 1111'
            },
            cvv: {
                selector: '#cvv',
                placeholder: '123'
            },
            expirationDate: {
                selector: '#expiration-date',
                placeholder: '10/2022'
            }
        }
    }, function (hostedFieldsErr, hostedFieldsInstance) {
        if (hostedFieldsErr) {
        console.error(hostedFieldsErr);
        return;
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                if (tokenizeErr) {
                    console.error(tokenizeErr);
                    return;
                }

                // If this was a real integration, this is where you would
                // send the nonce to your server.
                // console.log('Got a nonce: ' + payload.nonce);
                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            });
        }, false);
    });
    });
    </script>
@endsection
