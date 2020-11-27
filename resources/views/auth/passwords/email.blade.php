@extends('layouts.app')

@section('content')
<div class="bg-img2">
    <div class="container padd-top">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-6 my-4 pb-3 register">
                <div class="card">
                    <div class="account d-flex justify-content-center pt-4">
                        {{ __('Ripristina la Password') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row d-flex justify-content-center">
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

                            <div class="form-group row d-flex justify-content-center">
                                <div class="col-9 mt-3">
                                    <button type="submit" class="btn-blu">
                                        {{ __('Resetta la password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
