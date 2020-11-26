<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\View;
use App\Flat;

class ViewsChartDataController extends Controller
{
    ////////// FZ PER MOSTRARE LE STATISTICHE DELLE VIEWS RICEVUTE DA QUESTO DETERMINATO APPARTAMENTO
    
    function getMonthlyViewsData(){

        $flatId = $_GET['flatId'];                          // prendo il flat id dalla chiamata ajax con una variabile superglobale
        // $flatId = 1;                          // prendo il flat id dalla chiamata ajax con una variabile superglobale

        // >>>> 1 - inserisco tutti i mesi in un array (getAllMonths)
        
        $month_array = [];                                  // creo un array vuoto dove pushare tutti i mesi in cui ho ricevuto delle views per questo appartamento
        
        // estraggo solo created at per tutti i messaggi ricevuti per questo appartamento. otterrò un file json
        $views_dates = View::where('flat_id', '=', $flatId)->orderBy('created_at','ASC')->pluck('created_at');
        
        if (!empty($views_dates)){                          // se ci sono views
            foreach($views_dates as $unformatted_date){     // ciclo tutti i created at
                $date = new \DateTime($unformatted_date);   // li converto con carbon in date non formattate
                $month_number = $date->format('m');         // formatto a mo' di numero
                $month_name = $date->format('M');           // formatto a mo' di stringa
                $month_array[$month_number] = $month_name;  // inserisco ciascun created at nell'array vuoto, usando il numero a mo' di key e la stringa a mo' di value
            }
        }
        
        // >>>> 2 - ottenere il numero di views ricevute per ciascun mese per questo appartamento (getMonthlyViewsData)
        // ritornerà un array contenente due array
        
        $monthly_views_count_array = [];                    // array che conterrà i count delle views ricevute ogni mese
        $month_name_array = [];                             // array che conterrà tutti i nomi dei mesi in cui abbiamo ricevuto views
        
        if(!empty($month_array)){                               // SE l'array dei mesi non è vuoto
            foreach($month_array as $month_number => $month_name){  // lo cicliamo usando il num dei mesi come key e il nome dei mesi come value
                // >>>> 3 - ottenere il numero di views ricevute in un mese per questo appartamento e inserirli in un array (getMonthlyViewsCount)
                $monthly_views_count = View::whereMonth('created_at', $month_number)->where('flat_id', '=', $flatId)->get()->count();     // ottengo il numero delle views ricevute in quel mese
                array_push($monthly_views_count_array, $monthly_views_count);         // riempio i due array vuoti creati in precedenza
                array_push($month_name_array, $month_name);
            }
        }
        
        // calcolo il numero massimo di views
        $max_number = max($monthly_views_count_array);
        $max = round( ($max_number + 10 / 2) / 10) * 10;
        
        $monthly_views_data_array = [                     // creo un nuovo array in cui pusho i due array
            'months' => $month_name_array,
            'views_count_data' => $monthly_views_count_array,
            'max' => $max
        ];

        return $monthly_views_data_array;
    }
}
