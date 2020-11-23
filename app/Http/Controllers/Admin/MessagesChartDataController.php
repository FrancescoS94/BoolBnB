<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Flat;
use Auth;

class MessagesChartDataController extends Controller
{

    ////////// PER MOSTRARE LE STATISTICHE DI TUTTI I MESSAGGI RICEVUTI DA UN DETERMINATO UTENTE

    // fz per inserire tutti i mesi in un array
    function getAllMonths(){
        $allFlats = Flat::all();                            // stampo tutti gli appartamenti in una variabile
        $flatsId = [];                                      // creo un array vuoto
        for($i = 0; $i < count($allFlats); $i++){           // per ogni appartamento
            if($allFlats[$i]['user_id'] == Auth::id()){     // SE lo user_id di quell'appartamento è uguale allo user_id dell'utente loggato
                $flatsId[] = $allFlats[$i]['id'];           // inserisco questo id nell'array vuoto
            }
        } 

        // creo un array vuoto dove pushare tutti i mesi in cui ho ricevuto dei messaggi
        $month_array = [];

        // estraggo solo created at per tutti i messaggi. otterrò un file json
        $messages_dates = Message::where('flat_id', $flatsId)->orderBy('created_at','ASC')->pluck('created_at');
        
        if (!empty($messages_dates)){                       // se ci sono messaggi
            foreach($messages_dates as $unformatted_date){  // ciclo tutti i created at
                // dd($unformatted_date);
                $date = new \DateTime($unformatted_date);   // li converto con carbon in date non formattate
                $month_number = $date->format('m');         // formatto a mo' di numero
                $month_name = $date->format('M');           // formatto a mo' di stringa
                $month_array[$month_number] = $month_name;  // inserisco ciascun created at nell'array vuoto, usando il numero a mo' di key e la stringa a mo' di value
            }
        }
        console.log($month_array);
        return $month_array;
    }

    // fz per ottenere il numero di messaggi ricevuti in un mese
    function getMonthlyMessagesCount($month){
        $allFlats = Flat::all();                            // stampo tutti gli appartamenti in una variabile
        $flatsId = [];                                      // creo un array vuoto
        for($i = 0; $i < count($allFlats); $i++){           // per ogni appartamento
            if($allFlats[$i]['user_id'] == Auth::id()){     // SE lo user_id di quell'appartamento è uguale allo user_id dell'utente loggato
                $flatsId[] = $allFlats[$i]['id'];           // inserisco questo id nell'array vuoto
            }
        } 

        // conto quanti messaggi sono stati creati per l'utente nello stesso mese
        $monthly_messages_count = Message::whereMonth('created_at', $month)->where('flat_id', $flatsId)->get()->count();
        return $monthly_messages_count;

    }

    // fz per ottenere il numero di messaggi ricevuti per ciascun mese 
    // ritornerà un array contenente due array, ottenuto richiamando le due fz precedenti
    // sarà l'unica funzione che passeremo al grafico con una chiamata ajax
    function getMonthlyMessagesData(){
        $monthly_messages_count_array = [];                 // array che conterrà i count dei messaggi ricevuti ogni mese
        $month_name_array = [];                             // array che conterrà tutti i nomi dei mesi in cui abbiamo ricevuto un messaggio
        $month_array = $this->getAllMonths();               // otteniamo il valore dell'array dei mesi creato nella fz richiamata
        if(!empty($month_array)){                               // SE l'array dei mesi non è vuoto
            foreach($month_array as $month_number => $month_name){  // lo cicliamo usando il num dei mesi come key e il nome dei mesi come value
                $monthly_messages_count = $this->getMonthlyMessagesCount($month_number);    // ottengo grazie all fz richiamata il numero dei messaggi ricevuti in quel mese
                array_push($monthly_messages_count_array, $monthly_messages_count);         // riempio i due array vuoti creati in precedenza
                array_push($month_name_array, $month_name);
            }
        }
        $max_number = max($monthly_messages_count_array);
        $max = round(($max_number + 10/2)/10)*10;
        $monthly_messages_data_array = [                     // creo un nuovo array in cui pusho i due array
            'months' => $month_name_array,
            'messages_count_data' => $monthly_messages_count_array,
            'max' => $max,
        ];
        dd($monthly_messages_data_array);
        return $monthly_messages_data_array;
    }

    // ////////// BASE PER TENTARE DI MOSTRARE LE STATISTICHE DEI MESSAGGI RICEVUTI DA UN DETERMINATO UTENTE PER QUEL DETERMINATO APPARTAMENTO
    // //////////      BISOGNA PASSARE FLAT ID
    // // fz per inserire tutti i mesi in un array
    // function getAllMonths(Request $request){
    //     // creo un array vuoto dove pushare tutti i mesi in cui ho ricevuto dei messaggi
    //     $month_array = [];

    //     // estraggo solo created at per tutti i messaggi. otterrò un file json
    //     $messages_dates = Message::where('flat_id', '=', $request->id)->orderBy('created_at','ASC')->pluck('created_at');
        
    //     if (!empty($messages_dates)){                       // se ci sono messaggi
    //         foreach($messages_dates as $unformatted_date){  // ciclo tutti i created at
    //             // dd($unformatted_date);
    //             $date = new \DateTime($unformatted_date);   // li converto con carbon in date non formattate
    //             $month_number = $date->format('m');         // formatto a mo' di numero
    //             $month_name = $date->format('M');           // formatto a mo' di stringa
    //             $month_array[$month_number] = $month_name;  // inserisco ciascun created at nell'array vuoto, usando il numero a mo' di key e la stringa a mo' di value
    //         }
    //     }
    //     console.log($month_array);
    //     return $month_array;
    // }

    // // fz per ottenere il numero di messaggi ricevuti in un mese
    // function getMonthlyMessagesCount($month, Request $request){
    //     $allFlats = Flat::all();                            // stampo tutti gli appartamenti in una variabile
    //     $flatsId = [];                                      // creo un array vuoto
    //     for($i = 0; $i < count($allFlats); $i++){           // per ogni appartamento
    //         if($allFlats[$i]['user_id'] == Auth::id()){     // SE lo user_id di quell'appartamento è uguale allo user_id dell'utente loggato
    //             $flatsId[] = $allFlats[$i]['id'];           // inserisco questo id nell'array vuoto
    //         }
    //     } 

    //     // conto quanti messaggi sono stati creati per l'utente nello stesso mese
    //     $monthly_messages_count = Message::whereMonth('created_at', $month)->where('flat_id', '=', $request->id)->get()->count();
    //     return $monthly_messages_count;

    // }

    // // fz per ottenere il numero di messaggi ricevuti per ciascun mese 
    // // ritornerà un array contenente due array, ottenuto richiamando le due fz precedenti
    // // sarà l'unica funzione che passeremo al grafico con una chiamata ajax
    // function getMonthlyMessagesData(){
    //     $monthly_messages_count_array = [];                 // array che conterrà i count dei messaggi ricevuti ogni mese
    //     $month_name_array = [];                             // array che conterrà tutti i nomi dei mesi in cui abbiamo ricevuto un messaggio
    //     $month_array = $this->getAllMonths();               // otteniamo il valore dell'array dei mesi creato nella fz richiamata
    //     if(!empty($month_array)){                               // SE l'array dei mesi non è vuoto
    //         foreach($month_array as $month_number => $month_name){  // lo cicliamo usando il num dei mesi come key e il nome dei mesi come value
    //             $monthly_messages_count = $this->getMonthlyMessagesCount($month_number);    // ottengo grazie all fz richiamata il numero dei messaggi ricevuti in quel mese
    //             array_push($monthly_messages_count_array, $monthly_messages_count);         // riempio i due array vuoti creati in precedenza
    //             array_push($month_name_array, $month_name);
    //         }
    //     }
    //     $max_number = max($monthly_messages_count_array);
    //     $max = round(($max_number + 10/2)/10)*10;
    //     $monthly_messages_data_array = [                     // creo un nuovo array in cui pusho i due array
    //         'months' => $month_name_array,
    //         'messages_count_data' => $monthly_messages_count_array,
    //         'max' => $max,
    //     ];
    //     dd($monthly_messages_data_array);
    //     return $monthly_messages_data_array;
    // }
}
