
$(document).ready(function(){  
    (function() {
        var list=[];
        var placesAutocomplete = places({
            appId: 'plHDPE6IE51U',
            apiKey: '13f35e1233e3a7aedf08241d21430869',
            container: document.querySelector('#city'),
            templates: {
                value: function(suggestion){
                    list.push(suggestion);
                    return suggestion.name;
                }
            }
        }).configure({
            type: 'city',
            aroundLatLngViaIP: false,
        });
        
        document.getElementById('clickMe').addEventListener('click', function(){
            const city = document.getElementById('city').value;

            const form = document.getElementById('form');
            form.addEventListener('submit', (e) => {
                if(list.length == 0){
                    let city =document.getElementById('city').value = 'Inserisci una città!';
                    e.preventDefault(); 
                }
            }); 
            
            if(list.length != 0 || city != ''){
                for(var i=0; i<list.length; i++){
                    if(list[i]['name'] === city){
                        var lat = list[i]['latlng']['lat'];
                        var lng = list[i]['latlng']['lng'];
                        var querylat = document.getElementById('query_lat').value =  lat;
                        var querylng = document.getElementById('query_lng').value =  lng;
                    }
                }    
            }
        });
    })();
})