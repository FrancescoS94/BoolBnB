<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Message;
use App\Flat;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check()){
            $allFlats = Flat::all();                        // stampo tutti gli appartamenti in una variabile
            $flatsId = [];                                  // creo un array vuoto
            for($i = 0; $i < count($allFlats); $i++){       // per ogni appartamento
                if($allFlats[$i]['user_id'] == Auth::id()){ // SE lo user_id di quell'appartamento è uguale allo user_id dell'utente loggato
                    $flatsId[] = $allFlats[$i]['id'];       // inserisco questo id nell'array vuoto
                }
            }

            $messages = Message::all();                     // stampo tutti i messaggi
            // sovrascrivo messages soltanto con i messaggi in cui il flat_id è contenuto nell'array in cui ho memorizzato gli id degli appartamenti dell'utente loggato
            $messages = Message::where('flat_id', $flatsId)->orderBy('created_at','desc')->paginate(5);
            return view('admin.messages.index', compact('messages'));

        }
    }

    public function show(Message $message){
        return view('admin.messages.show', compact('message'));
    }
    
    public function create(){
        // $tags = Tag::all();
        // return view('admin.posts.create', compact('tags'));
    }

    public function store(Request $request){
        // $data = $request->all();

        // $request->validate([
        //     'titolo' => 'required|unique:posts',
        //     'articolo' => 'required|unique:posts',
        //     'img'=> 'image'
        // ]);
        
        // $data['user_id'] = Auth::id();
        // $data['slug'] = Str::slug($data['titolo'], '-');
        // $newPost = new Post;
        // if(!empty($data['img'])){
        //     $data['img'] = Storage::disk('public')->put('images',$data['img']);
        // }
        // $newPost->fill($data);
        // $salvato = $newPost->save();
        // // dd($data['tags']); // vedo i dati
        // $newPost->tags()->attach($data['tags']); // inserisco i dati
        // $newPost->tags()->sync($data['tags']);
        // if($salvato){
        //     return redirect()->route('admin.posts.index')->with('status', 'Articolo inserito correttamente');
        // };
    }
    
    public function destroy(Message $message){
        $message->delete();
        return redirect()->route('admin.messages.index')->with('status','Messaggio cancellato correttamente');
    }
    
    public function edit(Post $post){
        // $tags = Tag::all();
        // return view('admin.posts.create', compact('post','tags'));
    }
    

    // TENTATIVO PER SOVRASCRIVERE VALORE VIEWED MA NON ENTRA IN UPDATE

    public function update(Request $request, Message $message){

        $data = $request->all();
        dd($data);
        
        $data['viewed'] = !$message['viewed'];

        $message->update($data);
        
        return redirect()->route('admin.messages.index')->with('status','Messaggio impostato come letto');
    }
}
