@extends('layouts.main')
@section('title', 'Edição de Eventos')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Edit seu evento</h1>
    <form action="{{Route('event.update', $event->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name='image' class="form-control-file" id="title"><br>
            <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="img-preview">
        </div>

        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" value="{{$event->title}}" name='title' class="form-control" id="title" placeholder="Nome do Evento">
        </div>
        <div class="form-group">
            <label for="date">Data do Evento:</label>
            <input type="date" value="{{date('Y-m-d', strtotime($event->date));}}" name='date' class="form-control" id="date" placeholder="Data do Evento">
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" value="{{$event->city}}" name='city' class="form-control" id="city" placeholder="Cidade do Evento">
        </div>
        <div class="form-group">
            <label for="private">Tipo do evento</label>
            <select name="private" id="private" class="form-control" required>
                <option value="" disabled>Selecione um opção</option>
                <option value="0" {{$event->private == 0 ? "selected='selected" : ""}}>Privado</option>
                <option value="1" {{$event->private == 1 ? "selected='selected" : ""}}>Público</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Evento:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Faça uma descrição detalhada do evento">{{$event->description}}</textarea>
        </div>
        <div class="form-group">
            <h3>Infraestrutura:</h3>
            <div class="form-group">
              <input type="checkbox" name="items[]" id="" value="Cadeiras" {{$event->items == 'Cadeiras' ? "checked='checked" : ""}}> Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="" value="Palco" {{$event->items == 'Palco' ? "checked='checked" : ""}}> Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="" value="Open Food" > Open Food
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="" value="Fast Food"> Fast Food
            </div>
        </div>

        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk px-1"></i> Salvar</button>
    </form>
</div>


@endsection
