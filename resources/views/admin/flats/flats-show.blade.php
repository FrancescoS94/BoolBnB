
{{-- SHOW DEL SINGOLO APPARTAMENTO DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')

@section('script-in-head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container flat-show flat-title">
        <h1 class="pt-5">{{$flat->title}}</h1>
        <div class="row">
            {{-- IMAGE --}}
            <div class="col-md-12 col-lg-7">
                <div class="flat-img">
                    <img class="img-thumbnail border-0" src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}">
                    {{-- <img class="img-thumbnail border-0" src="https://martinaway.com/wp-content/uploads/2019/05/Airbnb-San-Francisco-1.jpg"  alt=""> --}}
                </div>
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
            <span class="pl-3">Data di creazione: {{ Carbon\Carbon::parse($flat->created_at)->settings(['toStringFormat' => 'j F Y', ]) }}</span>
            {{-- END --}}

            <a class="btn btn-primary" role="button" href="{{route('admin.flats.edit', $flat->id )}}" class="card-link">Modifica</a>
            <a class="btn btn-primary" role="button" href="{{ route('admin.payments.create', $flat->id)}}" class="card-link">Sponsorizza</a>
            <td>{{-- distruggi l'appartamento, attraverso l'id --}}
                <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Cancella</button>
                </form>
            </td>
        </div>

        {{-- prova chart js --}}
        <div class="container">
            <canvas id="myChartUno"></canvas>
            <canvas id="myChartDue"></canvas>
        </div>

    </div>
@endsection

@section('script-in-body')
<script>
    var myChartUno = document.getElementById('myChartUno').getContext('2d');
    
    var messagesChart = new Chart(myChartUno, {
        type: 'line', // tipo di grafico
        data:{
            labels:['Boston', 'Worcester', 'Springfield', 'Lowell', 'Cambridge', 'New Bedford'],
            datasets:[{
                label: 'Messaggi ricevuti',
                data:[
                    1596,
                    7979,
                    8273,
                    8787,
                    2536,
                    7643
                ]
            }]
        },
        options:{
            title:{
                display:true,
                text:'Messaggi ricevuti'
            },
            legend:{
                display:false
            }
        }
    })

    var myChartDue = document.getElementById('myChartDue').getContext('2d');

    var viewsChart = new Chart(myChartDue, {
        type: 'line', // tipo di grafico
        data:{
            labels:['Boston', 'Worcester', 'Springfield', 'Lowell', 'Cambridge', 'New Bedford'],
            datasets:[{
                label: 'Visualizzazioni ricevute',
                data:[
                    1596,
                    7979,
                    8273,
                    8787,
                    2536,
                    7643
                ]
            }]
        },
        options:{
            title:{
                display:true,
                text:'Visualizzazioni ricevute'
            },
            legend:{
                display:false
            }
        }
    })
</script>
@endsection