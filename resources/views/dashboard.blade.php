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
                            <td>0</td>
                            <td>
                                <a href="#" class="btn btn-success edit-btn" title="Editar"><ion-icon name="create-outline"></ion-icon></a>
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


@endsection
