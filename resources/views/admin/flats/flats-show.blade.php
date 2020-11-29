{{-- SHOW DEL SINGOLO APPARTAMENTO DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')

@section('script-in-head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
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
    <div class="container flat-show flat-title">
        {{-- input nascosto per passare l'id dell'appartamento alla chiamata ajax --}}
        <input id="flat" hidden value="{{$flat->id}}">

        <h2 class="pt-4">{{$flat->title}}</h2>
        <div class="row show-app">
            {{-- IMAGE --}}
            <div class="col-md-12 col-lg-7">
                <div class="flat-img">
                    <img class="img-thumbnail border-0" src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}">
                    {{-- <img class="img-thumbnail border-0" src="https://martinaway.com/wp-content/uploads/2019/05/Airbnb-San-Francisco-1.jpg"  alt=""> --}}
                </div>
                <span><span class="cb">Data di creazione:</span> {{ Carbon\Carbon::parse($flat->created_at)->settings(['toStringFormat' => 'j F Y', ]) }}</span>
            </div>
            {{-- DESCRIPTION, FEATURES & SERVICES --}}
            <div class="col-md-12 col-lg-5 jumbotron">
                <div>
                    <p class="text-justify flat-descr">{{$flat->description}}</p>
                </div>
                <ul>
                    <li class="float-left bed">
                        <img src="{{ asset('storage/bed.png')}}" alt="Icon Bed">
                        Letti: {{$flat->bed}}
                    </li>
                    <li>
                        <img src="{{ asset('storage/room.png')}}" alt="Icon Room">
                        Stanze: {{$flat->room}}
                    </li>
                    <li class="float-left wc">
                        <img src="{{ asset('storage/bath.png')}}" alt="Icon WC">
                        WC: {{$flat->wc}}
                    </li>
                    <li>
                        <img src="{{ asset('storage/plans.png')}}" alt="Icon Mq">
                        Mq: {{$flat->mq}}
                    </li>
                    <li>
                        <img src="{{ asset('storage/address.png')}}" alt="Icon Address">
                        Indirizzo: {{$flat->address->address}}
                    </li>
                </ul>
                <h2>Servizi</h2>
                <div class="services">
                    @foreach ($service as $service)
                        <p class="text-justify">· {{$service->service}}</p>
                    @endforeach
                </div>
            </div>
            <a class="btn-blu ml-3" role="button" href="{{route('admin.flats.edit', $flat->id )}}">Modifica</a>
            <a class="btn-blu mx-2" role="button" href="{{ route('admin.payments.create', $flat->id)}}">Sponsorizza</a>
            {{-- elimina l'appartamento, attraverso l'id --}}
            <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-red">Cancella</button>
            </form>
        </div>

        {{-- CHART JS --}}
        <div>
            <h2>Statistiche</h2>
            <p id="chart-empty" class="d-none">Qui vedrai le statistiche per questo appartamento: visualizzazioni e messaggi ricevuti</p>
            <div id="chart-messaggi" class="d-none py-1">
                <div>
                    <i class="fa fa-area-chart"></i>
                    <h3 class="pb-3">Messaggi</h3>
                </div>
                <div class="box-chart">
                    <canvas id="myChartUno"></canvas>
                </div>
            </div>
            <div id="chart-views" class="d-none py-1">
                <div>
                    <i class="fa fa-area-chart"></i>
                    <h3 class="pb-3">Visualizzazioni</h3>
                </div>
                <div class="box-chart mb-3">
                    <canvas id="myChartDue"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-in-body')
<script>
    // TENTATIVO PER MOSTRARE STATISTICHE DI MESSAGGI RELATIVI SOLO A QUESTO APPARTAMENTO

    (function($){

        var charts = {
            init:function(flatId){
                var flatId = $("input#flat").val();         // memorizzo il flat id prendendolo dall'input nascosto
                // qui vanno i fonts
                // qui vanno i colori
                this.ajaxGetMessagesMonthlyData(flatId);    // lo passo come dato alla chiamata ajax per prendere i messaggi solo di questo appartamento
                this.ajaxGetViewsMonthlyData(flatId);       // lo passo come dato alla chiamata ajax per prendere le views solo di questo appartamento

            },

            // MESSAGGI chiamata ajax per passare i dati da php a json
            ajaxGetMessagesMonthlyData:function(flatId){    // lo passo come dato alla chiamata ajax per prendere i messaggi solo di questo appartamento
                var urlPath = 'http://localhost:8000/get-messages-chart-data';
                $.ajax({
                    url: urlPath,
                    method: 'GET',
                    data: {
                        flatId: flatId
                    },
                    success: function(response){
                        charts.createCompletedMessagesChart(response);
                    },
                    error: function(){
                        console.log('grafici vuoti');
                        $('#chart-empty').removeClass('d-none');
                        $('#chart-empty').addClass('d-block');
                    }
                });
            },

            createCompletedMessagesChart:function(response){

                $grafico = $('#chart-messaggi');
                $grafico.removeClass('d-none');
                $grafico.addClass('d-block');

                var myChartUno = document.getElementById('myChartUno').getContext('2d');

                var messagesChart = new Chart(myChartUno, {
                    type: 'line',                                   // tipo di grafico
                    data:{
                        labels:response.months,                     // stampa i mesi nell'asse orizzontale
                        datasets:[{
                            label: 'Messaggi ricevuti',
                            backgroundColor: "#cb1f35",
                            data: response.messages_count_data,     // stampa il numero di messaggi nell'asse verticale
                        }]
                    },
                    options:{
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: response.max,              // calcolo il valore massimo dei messaggi per rendere il grafico adattabile a diverse moli di dati
                                    maxTicksLimit: 5
                                }
                            }]
                        },
                        title:{
                            display:false,
                            text:'Messaggi ricevuti'
                        },
                        legend:{
                            display:false
                        }
                    }
                })
            },

            // VIEWS chiamata ajax per passare i dati da php a json
            ajaxGetViewsMonthlyData:function(flatId){    // lo passo come dato alla chiamata ajax per prendere le views solo di questo appartamento
                var urlPath = 'http://localhost:8000/get-views-chart-data';
                $.ajax({
                    url: urlPath,
                    method: 'GET',
                    data: {
                        flatId: flatId
                    },
                    success: function(response){
                        charts.createCompletedViewsChart(response);
                    },
                    error: function(){
                        console.log('grafici vuoti');
                        $('#chart-empty').removeClass('d-none');
                        $('#chart-empty').addClass('d-block');
                    }
                });
            },

            createCompletedViewsChart:function(response){

                $grafico = $('#chart-views');
                $grafico.removeClass('d-none');
                $grafico.addClass('d-block');

                var myChartDue = document.getElementById('myChartDue').getContext('2d');

                var viewsChart = new Chart(myChartDue, {
                    type: 'line',                                   // tipo di grafico
                    data:{
                        labels:response.months,                     // stampa i mesi nell'asse orizzontale
                        datasets:[{
                            label: 'Visualizzazioni ricevute',
                            backgroundColor: "#cb1f35",
                            data: response.views_count_data,     // stampa il numero di visualizzazioni nell'asse verticale
                        }]
                    },
                    options:{
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: response.max,              // calcolo il valore massimo dei visualizzazioni per rendere il grafico adattabile a diverse moli di dati
                                    maxTicksLimit: 5
                                }
                            }]
                        },
                        title:{
                            display:false,
                            text:'Visualizzazioni ricevute'
                        },
                        legend:{
                            display:false
                        }
                    }
                })
            }
        }
        charts.init();

    })(jQuery);

    </script>
@endsection
