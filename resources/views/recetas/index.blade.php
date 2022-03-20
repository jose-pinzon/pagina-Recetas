@extends('layouts.app')


@section('botones')
    @include('includes.navegacion')
@endsection
@section('content')


            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            @endif


    <h1 class="text-center mb-5">Administra tus recetas </h1>

    <div class="col-md-10  mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
            <tr>
                <th scope="col" hidden></th>
                <th scope="col">Receta</th>

                <th scope="col">categoria</th>
                <th scope="col">acciones</th>
            </tr>
            </thead>
            <tbody>

                @foreach ( $recetas as $item)
                    <tr>

                        <td>{{$item->titulo}}</td>

                        <td>{{$item->categoria->nombre}}</td>
                        <td>

                            <eliminar-receta id="{{$item->id}}"></eliminar-receta>
                            <a href="{{route('recetas.edit',['receta' => $item->id ])}}"  class="btn btn-success d-block mb-2">Editar</a>
                            <a href="{{route('recetas.show',['receta' => $item->id ])}}"  class="btn btn-info d-block mb-2">Ver</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
          {{$recetas->links()}}
          <h2 class="text-center my-5"> Recetas que te gustan </h2>
          <div class="col-md-10 mx-auto bg-white p-3">

            @if(count($likesDados) > 0 )
            <ul>
                @foreach($likesDados as $like)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <p>{{$like->titulo}}</p>
                        <a class="btn btn-outline-success text-uppercase" href="{{route('recetas.show',['receta' =>  $like->id ])}}">Ver</a>
                    </li>
                @endforeach
            </ul>

            @else
                <p class="text-center">Aun no hay recetas guardadas <small> Dale me gusta a las recetas y apareceran aqui</small> </p>
            </div>

            @endif
    </div>


@endsection
