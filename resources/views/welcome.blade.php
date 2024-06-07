@extends('layouts.main')
@section('title', 'Página principal')

@section('content')


<div id="search-container" class="col-md-12">
     <h1>Busque um evento</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar">
    </form>
</div>
<div id="events-container" class="col-md-12">
        @if ($search)
            <h2>Buscando por: {{$search}}</h2>
        @else
            <h2>Próximos Eventos</h2>
        @endif

    <p class="subtitle">Veja os próximos eventos</p>
    <div id="cards-container" class="row">
        @foreach ($events as $event )
            <div class="card col-md-3">
                <img src="img/events/{{$event->image}}" alt="{{$event->title}}">
                <div class="card-body">
                    <div class="card-date">{{date('d/m/Y', strtotime($event->date))}}</div>
                    <h5 class="card-title">{{$event->title}}</h5>
                    <p class="cards-participants">{{count($event->users) == 0 ? 'Seja o primeiro a confirmar presença!' : count($event->users).' Participantes'}}</p>
                    <a href="{{Route('event.show', $event->id)}}" class="btn btn-success">Saiba Mais <i class="fa-solid fa-paper-plane ms-2"></i></a>
                </div>
            </div>
        @endforeach

        @if(count($events) == 0 && $search)
             <p>Evento {{$search}} não encontrado! <a href="/">Voltar</a></p>
        @elseif (count($events) == 0)
          <p>Não há eventos disponíveis!</p>
        @endif
    </div>
</div>


@endsection
