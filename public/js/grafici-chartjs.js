$(document).ready(function() {

(function($){

    var charts = {
        init:function(){
            var flatId = $("input#flat").val();         // memorizzo il flat id prendendolo dall'input nascosto
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

})