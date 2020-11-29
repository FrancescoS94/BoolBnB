{{-- SHOW DEL SINGOLO APPARTAMENTO DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')

@section('script-in-head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
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
        <div class="py-5">
            <h2>Statistiche</h2>
            <div>
                <i class="fa fa-area-chart"></i>
                <h3 class="pb-3">Messaggi</h3>
            </div>
            <div class="box-chart">
                <canvas id="myChartUno"></canvas>
            </div>
        </div>
        <div>
            <div>
                <i class="fa fa-area-chart"></i>
                <h3 class="pb-3">Visualizzazioni</h3>
            </div>
            <div class="box-chart mb-3">
                <canvas id="myChartDue"></canvas>
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
                        console.log('errore');
                    }
                });
            },

            createCompletedMessagesChart:function(response){

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
                        console.log('errore');
                    }
                });
            },

            createCompletedViewsChart:function(response){

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
