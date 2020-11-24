@extends('layouts.admin')
@section('content')

    <style>
                <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }
    .full-height {
        height: 100vh;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .position-ref {
        position: relative;
    }
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
    .content {
        text-align: center;
    }
    .title {
        font-size: 84px;
    }
    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
    .m-b-md {
        margin-bottom: 30px;
    }
</style>


    <div class="container">
        <h1>Sponsorizza un appartamento</h1>

        {{-- controllo errori --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <p>Puoi sponsorizzare un appartamento per 1, 3 o 6 giorni.</p>
        <p>Il tuo appartamento verrà mostrato in home page e nella pagina di ricerca, in evidenza rispetto agli altri appartamenti, per l'intera durata della sponsorizzazione.</p>

        {{-- form per la sponsorizzazione dell'appartamento, punta al controller Admin/PaymentController  --}}
        <form action="{{ route('admin.payments.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="flat_id">Scegli l'appartamento che vuoi sponsorizzare</label>
                <select class="form-control" id="flat_id" name="flat_id">
                    <option>Seleziona un appartamento</option>
                    @foreach($flats as $flat)
                    <option value="{{ $flat->id }}">{{ $flat->title }}</option>
                    {{-- <option>{{ $flat->id }}</option> --}}
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

            <button type="submit" class="btn btn-primary">Sponsorizza l'appartamento</button>
        </form>

        {{-- <div class="content">
            form pagamento
            <form method="post" id="payment-form" action="#">
                @csrf
                <section>
                    <label for="amount">
                        <span class="input-label">Amount</span>
                        <div class="input-wrapper amount-wrapper">
                            <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                        </div>
                    </label>

                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="button" type="submit"><span>Test Transaction</span></button>
            </form>
        </div> --}}
    </div>

    {{-- {{ $token }} {!! json_encode($token->toArray()) !!} --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }
              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script> --}}
@endsection
