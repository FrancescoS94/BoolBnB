{{-- SHOW DEL SINGOLO APPARTAMENTO DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')

@section('script-in-head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container flat-show flat-title">
        {{-- TENTATIVO PER MOSTRARE STATISTICHE DI MESSAGGI RELATIVI SOLO A QUESTO APPARTAMENTO --}}
        {{-- input nascosto per passare l'id dell'appartamento alla chiamata ajax --}}
        {{-- <form method="post">
            @csrf
            <input id="flat" hidden value="{{$flat->id}}">
        </form> --}}

        <h1 class="pt-5">{{$flat->title}}</h1>
        <div class="row">
            {{-- IMAGE --}}
            <div class="col-md-12 col-lg-7">
                <div class="flat-img">
                    <img class="img-thumbnail border-0" src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}">
                    {{-- <img class="img-thumbnail border-0" src="https://martinaway.com/wp-content/uploads/2019/05/Airbnb-San-Francisco-1.jpg"  alt=""> --}}
                </div>
                <span class="pl-3">Data di creazione: {{ Carbon\Carbon::parse($flat->created_at)->settings(['toStringFormat' => 'j F Y', ]) }}</span>
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
            <a class="btn-blu ml-2" role="button" href="{{route('admin.flats.edit', $flat->id )}}">Modifica</a>
            <a class="btn-blu mx-3" role="button" href="{{ route('admin.payments.create', $flat->id)}}">Sponsorizza</a>
            {{-- elimina l'appartamento, attraverso l'id --}}
            <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-red">Cancella</button>
            </form>
        </div>

        {{-- prova chart js --}}
        <div class="container pb-5">
            <div class="card-header">
                <i class="fa fa-area-chart"></i>
                Messaggi ricevuti
            </div>
            <div class="card-body">
                <canvas id="myChartUno" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Aggiornato al momento attuale</div>

        </div>
        <div class="container">
            <div class="card-header">
                <i class="fa fa-area-chart"></i>
                Visualizzazioni ricevute
            </div>
            <div class="card-body">
                <canvas id="myChartDue" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Aggiornato al momento attuale</div>
        </div>

    </div>
@endsection

@section('script-in-body')
<script>

//     // TENTATIVO PER MOSTRARE STATISTICHE DI MESSAGGI RELATIVI SOLO A QUESTO APPARTAMENTO

//     (function($){


//         var charts = {
//             init:function(){
//                 // qui vanno i fonts
//                 // qui vanno i coloring

//                 this.ajaxGetMessagesMonthlyData();

//             },

//             //chiamata ajax per passare i dati da php a json
//             ajaxGetMessagesMonthlyData:function(){
//                 var flat_id = $("input#flat").val();

//                 var urlPath = 'http://localhost:8000/get-messages-chart-data/'+flat_id;
//                 $.ajax({
//                     url: urlPath,
//                     method: 'GET',
//                     // data: flat_id,
//                     success: function(response){
//                         console.log(response);
//                         charts.createCompletedJobChart(response);
//                     },
//                     error: function(){
//                         console.log('errore');
//                     }
//                 });
//             },

//             createCompletedJobChart:function(response){

//                 var myChartUno = document.getElementById('myChartUno').getContext('2d');

//                 var messagesChart = new Chart(myChartUno, {
//                     type: 'line', // tipo di grafico
//                     data:{
//                         labels:response.months,
//                         datasets:[{
//                             label: 'Messaggi ricevuti',
//                             data: response.messages_count_data,
//                         }]
//                     },
//                     options:{
//                         scales: {
//                             yAxes: [{
//                                 ticks: {
//                                     min: 0,
//                                     max: response.max,
//                                     maxTicksLimit: 5
//                                 }
//                             }]
//                         },
//                         title:{
//                             display:false,
//                             text:'Messaggi ricevuti'
//                         },
//                         legend:{
//                             display:false
//                         }
//                     }
//                 })
//             }
//         }
//         charts.init();
//     })(jQuery);


//     var myChartDue = document.getElementById('myChartDue').getContext('2d');

//     var viewsChart = new Chart(myChartDue, {
//         type: 'line', // tipo di grafico
//         data:{
//             labels:['Boston', 'Worcester', 'Springfield', 'Lowell', 'Cambridge', 'New Bedford'],
//             datasets:[{
//                 label: 'Visualizzazioni ricevute',
//                 data:[
//                     1596,
//                     7979,
//                     8273,
//                     8787,
//                     2536,
//                     7643
//                 ]
//             }]
//         },
//         options:{
//             title:{
//                 display:false,
//                 text:'Visualizzazioni ricevute'
//             },
//             legend:{
//                 display:false
//             }
//         }
//     })
// </script>
@endsection
