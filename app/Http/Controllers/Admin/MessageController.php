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
    
    public function show(Post $post){
        // $users = User::all();
        // $id = $post['user_id'];
        // $user = $users->find($id);
        // $nomeUtente = $user['name'];
        // $tags = $post['tags'];
        // return view('admin.posts.show', compact('post', 'nomeUtente','tags'));
    }
    
    public function destroy(Post $post){
        // $post->delete();
        // return redirect()->route('admin.posts.index')->with('status','Articolo cancellato correttamente');
    }
    
    public function edit(Post $post){
        // $tags = Tag::all();
        // return view('admin.posts.create', compact('post','tags'));
    }
    
    public function update(Request $request, Post $post){
        // $data = $request->all();
        
        // $request->validate([
        //     // 'titolo' => 'required|unique:posts',
        //     // 'articolo' => 'required|unique:posts',
        //     'titolo' => [
        //         'required',
        //         Rule::unique('posts')->ignore($post), // regola che permette di non controllare rispetto all'unicità anche il titolo che sto modidficando. NECESSARIO INSERIRE use Illuminate\Validation\Rule;
        //     ],
        //     'articolo' => [
        //         'required',
        //         Rule::unique('posts')->ignore($post),
        //     ],
        //     'img'=> 'image'
        // ]);
        
        // $data['slug'] = Str::slug($data['titolo'], '-');

        // if(empty($data['tags'])){                   // SE l'array dei tags è vuoto
        //     $post->tags()->detach();                    // elimino tutti i tags salvati
        // } else {                                    // ALTRIMENTI se l'array dei tags non è vuoto e ci sono modifiche
        //     $post->tags()->sync($data['tags']);         // con sync aggiorno i tags salvati
        // }
        
        // if(!empty($data['img'])){                   // SE da form è stata inserita una nuova immagine
        //     if(!empty($post['img'])){               // E SE era già stata caricata un'immagine per questo articolo
        //         Storage::disk('public')->delete('images',$post['img']); // all'interno della cartella public > storage > images cancello l'immagine memorizzata in precedenza
        //     }
        //     $data['img'] = Storage::disk('public')->put('images',$data['img']); // all'interno della stessa cartella memorizzo il nuovo file
        // }

        // $post->update($data);
        
        // return redirect()->route('admin.posts.index')->with('status','Articolo modificato correttamente');
    }
}
