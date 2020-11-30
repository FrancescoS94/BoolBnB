@extends('layouts.app')

@section('head')
    {{-- SCRIPT DI ALGOLIA --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script> --}}
    <script src="js/algolia.js" type="text/javascript"></script>
    <style>
        #erroreRicerca{ 
            width: 6rem;
            position: relative;
            left: 42%;
            top: -20px;
            font-size: 18px;
            width: 180px !important;
            padding: 15px 13px;
            border-radius: 9px;
        }
    </style>
@endsection

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

                            {{-- <div class="form-group row justify-content-center">
                                <div class="col-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Ricordami') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

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