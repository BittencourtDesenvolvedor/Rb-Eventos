<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){

        $search = request('search');
            if($search){
                $events = Event::where([
                    ['title', 'like', '%'.$search.'%']
                ])->get();
            }else{
                $events = Event::all();
            }
            return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create(){
        return view('events/create');
   }

   public function store(Request $request){
    $events = new Event;
    $events->title = $request->title;
    $events->date = $request->date;
    $events->city = $request->city;
    $events->private = $request->private;
    $events->description = $request->description;
    $events->items = $request->items;

    if($request->hasFile('image') != "" && $request->file('image')->isValid()){
        $requestImage = $request->image;
        $extension = $requestImage->extension();
        $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
        $requestImage->move(public_path('img/events'), $imageName);
        $events->image = $imageName;

      /*  $user = auth()->user();
        $events->user_id = $user->id;*/

        $events->save();
        return redirect()->route('create')->with('msg', 'Evento criado com sucesso!');

    }else{
        return redirect('/events/create')->with('error', 'Selecione uma imagem para o seu evento');
    }
    }
    public function show($id){

        $event = Event::findOrFail($id);
        return view('events/show', ['event' => $event]);
    }

}
