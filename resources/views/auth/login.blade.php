@extends('layouts.app')

@section('content')
<div class="bg-img2">
    <div class="container padd-top">
        <div class="row justify-content-center pt-5">
            <div class="col-md-9 col-lg-6 my-4 pb-5 register">
                <div class="card">
                    <div class="account d-flex justify-content-center pt-4">
                        {{ __('Accedi') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row justify-content-center">
                                <label for="email" class="col-md-4 col-form-label text-md-right"></label>

                                <div class="col-9">
                                    <input id="email" type="email" placeholder="Indirizzo Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <label for="password" class="col-md-4 col-form-label text-md-right"></label>

                                <div class="col-9">
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="col-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Ricordami') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="col-9 mt-4">
                                    <button type="submit" class="btn-blu">
                                        {{ __('Accedi') }}
                                    </button>
                                </div>
                                <div class="col-9 d-flex justify-content-center pt-4">
                                    <p>Non hai un account?
                                        <a href="{{ route('register') }}">Registrati</a>
                                    </p>
                                </div>
                                {{-- <div class="col-9 mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="" href="{{ route('password.request') }}">
                                            {{ __('Hai dimenticato la password?') }}
                                        </a>
                                    @endif
                                </div> --}}
                            </div>
                        </form>
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
