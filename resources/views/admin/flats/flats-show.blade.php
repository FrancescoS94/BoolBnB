
{{-- SHOW DEL SINGOLO APPARTAMENTO DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')
@section('content')


    <div class="container flat-show flat-title">
        <h1 class="pt-5">{{$flat->title}}</h1>
        <div class="row">
            {{-- IMAGE --}}
            <div class="col-md-12 col-lg-7">
                <div class="flat-img">
                    {{-- src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}" --}}
                    <img class="img-thumbnail border-0" src="https://www.triesteallnews.it/wp-content/images/2019/08/affitti-brevi-appartamenti.jpg"  alt="">
                </div>
            </div>
            {{-- DESCRIPTION, FEATURES & SERVICES --}}
            <div class="col-md-12 col-lg-5 jumbotron">
                <div>
                    <p class="text-justify flat-descr">{{$flat->description}}</p>
                </div>
                <ul>
                    <li class="float-left bed">
                        <img src="{{asset('image\bed.png')}}" alt="Icon Bed">
                        Letti: {{$flat->bed}}
                    </li>
                    <li>
                        <img src="{{asset('image\room.png')}}" alt="Icon Room">
                        Stanze: {{$flat->room}}
                    </li>
                    <li class="float-left wc">
                        <img src="{{asset('image\bath.png')}}" alt="Icon WC">
                        WC: {{$flat->wc}}
                    </li>
                    <li>
                        <img src="{{asset('image\plans.png')}}" alt="Icon Mq">
                        Mq: {{$flat->mq}}
                    </li>
                    <li>
                        <img src="https://www.flaticon.com/svg/static/icons/svg/1295/1295181.svg" alt="Icon Address">
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
            <span class="pl-3">Data di creazione: {{$flat->created_at}}</span>
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
        </div>
    </div>
@endsection
