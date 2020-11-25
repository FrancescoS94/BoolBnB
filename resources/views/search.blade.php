@extends('layouts.app')
@section('content')

<div class="container-fluid layout">

  {{-- <div class="row filtri">
    <div class="col-12 filters">
      <p>FILTRI</p>
    </div>
  </div> --}}

  <section class="container-fluid sponsor">
    <h2>Scorri i nostri migliori appartamenti</h2>
    <div class="row">
        <i class="fas fa-chevron-left left"></i>
        <div class="lista appartamenti">
            @foreach ($flatsSpons as $flatSpons)
            <div style="background-image: url({{asset('storage/'. $flatSpons->image)}});" class="col-12 col-sm-6 col-md-4 col-lg-3 box-group">
                <a href="{{ route('flats.show', $flatSpons->id) }}">
                    <div class="box-descr" style="color:#fff">
                        <h5><span class="badge">Città</span></h5>
                        <h3>{{ $flatSpons->title}}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <i class="fas fa-chevron-right right"></i>
    </div>
  </section>

  <div class="container ricerca">
    @foreach ($flatsInRadius as $flat)
    <div class="row search">
      <div class="foto col-9 col-sm-6 col-md-6 col-lg-6 col-xl-5 ">
        <a href="{{ route('flats.show', $flat->id) }}"><img id="img-search" src="{{ asset('storage/'.$flat->image ) }}" class="img-fluid" alt="{{ $flat->title}}"></a>
      </div>

      <div class="my-auto col-9 col-sm-6 col-md-6 col-lg-6 col-xl-6 ">
        <div class="flat-text">
          <a href="{{ route('flats.show', $flat->id) }}">
            <h5 class="card-title">{{ $flat->title}}</h5>
            <p>{{ $flat->address->address }}</p>
            <ul>
              <li>
                <img src="https://www.flaticon.com/svg/static/icons/svg/2286/2286105.svg" alt="">
                Letti: {{$flat->bed}}
              </li>
              <li>
                <img src="https://www.flaticon.com/svg/static/icons/svg/578/578059.svg" alt="">
                Stanze: {{$flat->room}}
              </li>
            </ul>
              <ul>
                <li>
                  <img src="https://www.flaticon.com/svg/static/icons/svg/3030/3030330.svg" alt="">
                  WC: {{$flat->wc}}
                </li>
                <li>
                  <img src="https://www.flaticon.com/svg/static/icons/svg/515/515159.svg" alt="">
                  Mq: {{$flat->mq}}
                </li>
              </ul>
          </a>
          <div class="flat-service">
            @foreach($flat->services as $service)
            <span> {{ $service->service }} </span>
            @endforeach
          </div>
        </div>
      </div>

    </div> {{-- chiusura row search--}}
    @endforeach

  </div> {{-- chiusura container-fluid ricerca--}}

</div> {{-- chiusura layout --}}


@endsection
