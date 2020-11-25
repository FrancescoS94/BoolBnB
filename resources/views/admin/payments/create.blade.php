@extends('layouts.admin')

@section('script-in-head')
    {{-- STYLE BRAINTREE PER CAMPI DATI CARTA DI CREDITO --}}
    <style>
        #card-number, #cvv, #expiration-date{
            background:white;
            height: 38px;
            border: 1px solid #ced4da;
            padding: .375rem .75rem;
            border-radius: .25rem;
        }
    </style>
@endsection

@section('content')

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    {{-- SCRIPT BRAINTREE --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>
    
    <div class="container">
        <h1>Sponsorizza un appartamento</h1>

        {{-- inserire costi sponsorizzazioni --}}

        <p>Puoi sponsorizzare un appartamento per 1, 3 o 6 giorni.</p>
        <p>Il tuo appartamento verrà mostrato in home page e nella pagina di ricerca, in evidenza rispetto agli altri appartamenti, per l'intera durata della sponsorizzazione.</p>

        {{-- HOSTED FORM BRAINTREE --}}

        <div class="col-md-6 offset-md-3">
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
            <form action="{{ route('admin.payments.store') }}" method="POST" id="payment-form">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email">
                </div>

                <div class="form-group">
                    <label for="name_on_card">Name on Card</label>
                    <input type="text" class="form-control" id="name_on_card" name="name_on_card">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="postalcode">Postal Code</label>
                            <input type="text" class="form-control" id="postalcode" name="postalcode">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="flat_id">Scegli l'appartamento che vuoi sponsorizzare</label>
                    <select class="form-control" id="flat_id" name="flat_id">
                        <option>Seleziona un appartamento</option>
                        @foreach($flats as $flat)
                        <option value="{{ $flat->id }}">{{ $flat->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="rate_id">Scegli la tua sponsorizzazione</label>
                    <select class="form-control" id="rate_id" name="rate_id">
                        <option>Seleziona una tipologia di sponsorizzazione</option>
                        <option value="1">24 ore - 1 giorno</option>
                        <option value="2">72 ore - 3 giorni</option>
                        <option value="3">144 ore - 6 giorni</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="cc_number">Credit Card Number</label>

                        <div class="form-group" id="card-number">

                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="expiry">Expiry</label>

                        <div class="form-group" id="expiration-date">

                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cvv">CVV</label>

                        <div class="form-group" id="cvv">

                        </div>
                    </div>

                </div>

                <div class="spacer"></div>

                <div id="paypal-button"></div>

                <div class="spacer"></div>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button type="submit" class="btn btn-success">Submit Payment</button>
            </form>
        </div>
    </div>
    {{-- SCRIPT HOSTED FORM --}}

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
            //   console.log('Got a nonce: ' + payload.nonce);
                // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          }, false);
        });
      });
    </script>

    
@endsection
