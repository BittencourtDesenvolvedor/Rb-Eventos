@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus eventos</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if (count($events) > 0)
           <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                         <tr>
                            <td scope="row">{{$loop->index + 1 }}</td>
                            <td><a href="/show/{{$event->id}}">{{$event->title}}</a></td>
                            <td>{{count($event->users)}}</td>
                            <td>
                                <a href="{{Route('event.edit', $event->id)}}" class="btn btn-success edit-btn" title="Editar"><ion-icon name="create-outline"></ion-icon></a>
                                <form action="/delete/{{$event->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn" title="Deletar"><ion-icon name="trash-outline"></button>
                                </form>
                            </td>
                         </tr>
                    @endforeach
                </tbody>
           </table>
        @else
             <p>Você ainda não tem eventos, <a href="{{Route('create')}}">Criar Eventos</a></p>
        @endif
    </div>
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Eventos que estou participando</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if(!is_null($eventsasparticipant) && count($eventsasparticipant) > 0)

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventsasparticipant as $event)
                     <tr>
                        <td scope="row">{{$loop->index + 1 }}</td>
                        <td><a href="/show/{{$event->id}}">{{$event->title}}</a></td>
                        <td>{{count($event->users)}}</td>
                        <td>
                            <form action="{{Route('event.leave', $event->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger edit-btn" title="Sair do Evento"><ion-icon name="exit-outline"></ion-icon> Sair do Evento</button>
                            </form>


                        </td>
                     </tr>
                @endforeach
            </tbody>
       </table>

        @else
             <p>Você ainda não confirmou presença em nenhum evento! <a href="/">Todos os Eventos </a></p>
        @endif

    </div>

@endsection
