{{-- PAGINA INDEX --}}
@extends('layouts.app')
@section('content')

{{-- BANNER --}}
<section class="bg-img">
    <div class="container-fluid">
        <div class="jumbotron col-sm-8 col-md-6 col-lg-6">
            <h1>Viaggiare sentendoti a casa tua</h1>
        </div>
    </div>
</section>

<section class="container-fluid sponsor">
    
    {{-- FRANCESCO --}}
    {{-- A: {{ route('flats.show', $flatSpons->id) }} --}}
    {{-- IMG: {{ $flatSpons->image }} --}}
    {{-- H6: {{ $flatSpons->title}} --}}
    {{-- H5: aggiungere nel database la città --}}
    <h2>Scorri i nostri migliori appartamenti</h2>
    <div class="row">
        <i class="fas fa-chevron-left left"></i>
        <div class="lista appartamenti">
            @foreach ($flatsSpons as $flatSpons)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 box-group">
                <div class="box-img">
                    <a href="{{ route('flats.show', $flatSpons->id) }}">
                        <img class="" src="{{ asset('storage/' . $flatSpons->image) }}" alt="">
                    </a>
                </div>
                <div class="box-descr">
                    <h5>Milano</h5>
                    <h6>{{ $flatSpons->title}}</h6>
                </div>
            </div>
            @endforeach
        </div>
        <i class="fas fa-chevron-right right"></i>

    </div>

    <script>

       //$("#screenName").on("keyup",function()

        $(document).on('click','a.search-btn',function(){
            var search = $('input.search-text').val();
            if(search != ''){

                $.ajax({
                    type: "GET",
                    url:  "http://localhost:8000/api/addresses",
                    success: function(response){
                        for(var i=0; i<response.length; i++){
                            var indirizzo = response[i]['address'];

                            if(indirizzo.toLowerCase().includes(search)){
                                var obj=response[i];
                                var objpassato=(JSON.stringify(obj));
                                //console.log(JSON.stringify(obj));

                                $.ajax({
                                    type: "POST",
                                    url: " api/addresses",
                                    data: obj,
                                    dataType: "json",
                                }).done(function(messaggio){
                                    alert("Successo");
                                }).fail(function(){
                                    alert("Errore");
                                });
                            }// chiusura if
                        } // chiusura for
                    },error: function(error){
                        console.log('errore', error);
                    }
                })
            }
        });
                /* $.ajax({indirizzo.filter(query)
                type: "GET",
                url: "http://localhost:8000/api/addresses",
                data: 
                success: function (response) {

                    console.log(response); */

                    /* for(var i=0; i<response.length; i++){
                        var indirizzo = response[i]['address'];
                        
                        if(indirizzo.filter(query)){
                            console.log('okay trovata');
                        }else{
                            console.log('non trovato');
                        }  
                    } 
                },error:function(error){
                    console.log('errore', error)
                }

                
            }); */


            /* $("#screenName").on("keyup",function(){
            var screenName=$(this).val();

            if(screenName!='')
            {
            $.ajax({
                    type: 'post',
                    url:  'screenNameCheck.php',
                    data: 'Screen_Name=' + screenName,

                    success: function (r) {
                        $('.screenNameError').html(r);
                    }
                })
            }

            /* {
                    query: search
                },
            }); */

            
        

        
    </script>
</section>
@endsection


{{-- <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('admin/home') }}">Home</a>
            @else

                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div> --}}
