$(document).ready(function() {
    var list=[]; // array di ricerca
    (function() { // funzione algolia di ricerca
        var placesAutocomplete = places({
            appId: 'plHDPE6IE51U',
            apiKey: '13f35e1233e3a7aedf08241d21430869',
            container: document.querySelector('#city1'),
            templates: {
                value: function(suggestion){
                    list.push(suggestion); // popolo l'array con i valori di ritorno di algolia
                    return suggestion.name;
                }
            }
        }).configure({
            type: 'city',
            aroundLatLngViaIP: false,
        });
    })(); // fine funzione algolia di ricerca


    // funzione click bottone
    $('#click').unbind().bind('click', function(){   /* metodo alternativo document.getElementById('clickMe').addEventListener('click', function(){}); // chiusura evento bottone */
    $('.ricerca').empty();
    var city =  document.getElementById('city1').value;
    if(city == ''){
        document.querySelector('.left-layout').innerHTML = '<h2>Inserisci un città!</h2>';
    }


    let selectedMq = $("select#mq").children("option:selected").val();

    let serviceList = []; // torna tutti i servizi scelti
        $('.serviceClick:checked').each(function(){
        serviceList.push(this.value);
    });

   
    
    

    if(list.length != 0){
        var geo= [];
        for(var i=0; i<list.length; i++){
        if(list[i]['name'] === city){ // se c'è corrispondenza
        var lat = list[i]['latlng']['lat'];
        var lng = list[i]['latlng']['lng'];

        // loro due prendono i valori di latitudine e longitudine e li spediscono al controller!
        var querylat = document.querySelector('.query_lat').value =  lat;
        var querylng = document.querySelector('.query_lng').value =  lng;
        if(!geo.includes(querylat) && !geo.includes(querylng)){
            geo.push(querylat);
            geo.push(querylng);
        }

        } // chiusura if list[i]
        } // chiusura for

        list= [];
    }else{
        let lat = $('.query_lat').val();
        let lng = $('.query_lng').val();

        geo = [
        lat,
        lng
        ];
    }


    // prendo i valori dei filtri flats
    let room = $('#room').val();
    let bed = $('#bed').val();
    let wc = $('#wc').val();

    // richiamo la funzione call ed effettuo la chiamata!
    call(geo,room,bed,wc,selectedMq,serviceList);
    });
    // funzione chiamata ajax con parametro in ingresso

    function call(listageo, room='', bed='', wc='', selectedMq='',serviceList= ''){
    $.ajax({
            /* cache: false, */
            type: "GET",
            url: "http://localhost:8000/flats",
            data: {
            geo: listageo,
            room: room,
            bed: bed,
            wc: wc,
            selectedMq: selectedMq,
            serviceList: serviceList
            },
            dataType: "json",
    }).done(function(response){
        console.log(response);
        compiler(response); // richiamo la funzione per compilare il model
    }).fail(function(error){
        console.log('errore',error);
    });
    }


    function compiler(response){
    // copia baffi
    let source = $("#template").html();
    let template = Handlebars.compile(source);
    for(let i=0; i < response.length; i++){
        let context={
        title: response[i].title,
        address: response[i].address_id,
        bed: response[i].bed,
        description: response[i].description,
        mq: response[i].mq,
        room: response[i].room,
        wc: response[i].wc,
        image: response[i].image,
        id: response[i].id
        }
        let html = template(context);
        let temp = $('.ricerca').append(html);
    }
    }

    $(document).on("click", "#paginaInterna", function(){

        var city =  document.getElementById('city1').value;
        let lat = document.querySelector('.query_lat').value; //$('.query_lat').val(); 
        let lng = document.querySelector('.query_lng').value; //$('.query_lng').val();
        var link = $(this).attr('href');

        let geo = [
        lat,
        lng,
        city
        ];

        //  TENTATIVO PER PARLARE CON FLAT SEARCH
        //console.log(geo);
        //console.log(link, city, lat, lng);
    /*     $.ajax({
            type: "get",
            url: link,       //"http://localhost:8000/flats/" + 
            data: {
            geo: geo 
            },
            dataType: "json", 
            success: function (response){}
        }); */

    });

})