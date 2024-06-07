<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
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

        $user = auth()->user();
        $events->user_id = $user->id;

        $events->save();
        return redirect()->route('create')->with('msg', 'Evento criado com sucesso!');

    }else{
        return redirect('/events/create')->with('error', 'Selecione uma imagem para o seu evento');
    }
    }

    public function show($id){

        $event = Event::findOrFail($id);

        $user= auth()->user();
        $hasUserJoined = false;

        if($user){
             $userEvents = $user->eventsasparticipant->toArray();
             foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
             }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();
        return view('events/show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function edit($id){
        $user = auth()->user();
        $event = Event::findOrFail($id);

        if($user->id != $event->user_id){
            return redirect('/dashboard');
        }

        return view('events/edit', ['event' => $event]);
    }

    public function update(Request $request){

        $data = $request->all();

        if($request->hasFile('image') != "" && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);
        return redirect()->route('dashboard')->with('msg', 'Evento editado com sucesso!');
    }


    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;
        $eventsAsParticipante = $user->eventsasparticipant;
        return view('dashboard', ['events' => $events, 'eventsasparticipant' => $eventsAsParticipante]);
    }

    public function destroy($id){
        $event = Event::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso!');
    }
    public function joinEvent($id){
        $user = auth()->user();
        $user->eventsasparticipant()->attach($id);

        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg', "Sua presença fo confirmada" . $event->title );
    }

    public function leaveEvent($id){
        $user = auth()->user();
        $user->eventsasparticipant()->detach($id);
        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg', "Você saiu com sucesso do evento: " . $event->title );
    }
}

