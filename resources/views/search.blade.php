
@extends('layouts.app')
@section('content')

<div class="container-fluid layout">

  <div class="row filtri">
    <div class="col-12 filters">
      <p>FILTRI</p>
    </div>
  </div>

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


  <div class="container-fluid ricerca">
    @foreach ($flatsSpons as $flatSpons)
    <div class="row search">
      <div class="col-5">
        <a href="{{ route('flats.show', $flatSpons->id) }}"><img id="img-search" src="{{ asset('storage/'.$flatSpons->image ) }}" class="img-fluid" alt="{{ $flatSpons->title}}"></a>
      </div>

      <div class="col-6">
        <div class="flat-text">
          <a href="{{ route('flats.show', $flatSpons->id) }}">
            <h5 class="card-title">{{ $flatSpons->title}}</h5>
            <p>{{ $flatSpons->address->address }}</p>
            <ul>
              <li>
                <img src="https://www.flaticon.com/svg/static/icons/svg/2286/2286105.svg" alt="">
                Letti: {{$flatSpons->bed}}
              </li>
              <li>
                <img src="https://www.flaticon.com/svg/static/icons/svg/578/578059.svg" alt="">
                Stanze: {{$flatSpons->room}}
              </li>
            </ul>
              <ul>
                <li>
                  <img src="https://www.flaticon.com/svg/static/icons/svg/3030/3030330.svg" alt="">
                  WC: {{$flatSpons->wc}}
                </li>
                <li>
                  <img src="https://www.flaticon.com/svg/static/icons/svg/515/515159.svg" alt="">
                  Mq: {{$flatSpons->mq}}
                </li>
              </ul>
          </a>
          <div class="flat-service">
            @foreach($flatSpons->services as $service)
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
