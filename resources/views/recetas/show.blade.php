
@extends('layouts.app')
@section('botones')
    <a href="{{route('recetas.home')}}" class="btn btn-info">

        <svg xmlns="http://www.w3.org/2000/svg" width="30px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
          </svg>
        Regresar</a>
@endsection
@section('content')

<article class="content-receta bg-white p-5 shadow">
    <h1 class="text-center mb-4">{{$receta->titulo}}</h1>

    <div class="image-receta">

        <img src="/storage/{{$receta->imagen}}" alt="img" class="w-100">
    </div>

    <section class="receta-meta mt-2">
        <p>
            <span class="font-weight-bold text-primary">Escrito en:</span>
            <a class="text-dark" href="{{route('categorias.show', ['categoriaReceta'=> $receta->categoria->id])}}">
                {{$receta->categoria->nombre}}
            </a>
        </p>

        <p>
            <span class="font-weight-bold text-primary"> Autor:</span>

            <a class="text-dark" href="{{route('perfil.show',['perfil'=> $receta->usuario->id ])}}">
                {{$receta->usuario->name}}
            </a>
        </p>
        <p>
            <span class="font-weight-bold text-primary"> Creado en:</span>
            @php
                $fecha = $receta->created_at
            @endphp
            <moment fecha="{{ $fecha }}"></moment>


        </p>
        <div class="ingredientes">
                <h2 class="my-3 text-primary"> Ingredientes </h2>

                {{-- TODO: esto se imprime asi porque se guardo contrix y contienen etiquetas --}}
                {!!$receta->ingredientes!!}
        </div>
        <div class="Preparacion">
                <h2 class="my-3 text-primary"> Intrucciones </h2>


                {!!$receta->preparacion!!}
        </div>
        <div class="justify-content-center row text-center">
            <component-like   like="{{ $like }}"   likes="{{ $cantidadLikes }}"    receta_id="{{ $receta->id }}" ></component-like>
        </div>
    </section>
</article>
@endsection
