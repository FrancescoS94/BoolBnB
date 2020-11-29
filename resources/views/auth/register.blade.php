@extends('layouts.app')

@section('content')
<div class="bg-img2">
    <div class="container padd-top">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-6 pt-4 mt-1 register">
                <div class="card">
                    <div class="account d-flex justify-content-center pt-4">
                        {{ __('Crea un Account') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row d-flex justify-content-center">
                                {{-- Dentro ogni "label": {{ __('Name') }} --}}
                                {{-- class di label: col-md-4 col-form-label text-md-right --}}
                                <label for="name"></label>

                                <div class="col-9">
                                    <input id="name" type="text" placeholder="Nome" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="lastname"></label>

                                <div class="col-9">
                                    <input id="lastname" type="text" placeholder="Cognome" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="email"></label>

                                <div class="col-9">
                                    <input id="email" type="email" placeholder="Indirizzo Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="password"></label>

                                <div class="col-9">
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="password-confirm"></label>

                                <div class="col-9">
                                    <input id="password-confirm" type="password" placeholder="Conferma Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <div class="col-9 mt-4">
                                    <button type="submit" class="btn-blu">
                                        {{ __('Iscriviti') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="col-12 d-flex justify-content-center pt-4">
                            <p>Hai già un account?
                                <a href="{{ route('login') }}">Accedi</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-in-body')
<script>
    // SCRIPT DI ALGOLIA
        (function() {
            var list=[];
            var placesAutocomplete = places({
                appId: 'plHDPE6IE51U',
                apiKey: '13f35e1233e3a7aedf08241d21430869',
                container: document.querySelector('#city'),
                templates: {
                    value: function(suggestion){
                        list.push(suggestion);
                        return suggestion.name;
                    }
                }
            }).configure({
                type: 'city',
                aroundLatLngViaIP: false,
            });

            document.getElementById('clickMe').addEventListener('click', function(){
                var city =  document.getElementById('city').value;
                for(var i=0; i<list.length; i++){
                    if(list[i]['name'] === city){
                        var lat = list[i]['latlng']['lat'];
                        var lng = list[i]['latlng']['lng'];
                        var querylat = document.getElementById('query_lat').value =  lat;
                        var querylng = document.getElementById('query_lng').value =  lng;
                    }
                }
            });
        })();
</script>
@endsection