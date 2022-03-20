@extends('layouts.app')

@section('estilos')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('botones')
<a href="{{route('recetas.home')}}" class="btn btn-primary  mr-2 text-white">

    <svg xmlns="http://www.w3.org/2000/svg" width="30px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
      </svg>
    Volver</a>

@endsection
@section('content')

    <h1 class="text-center mb-5">Editar receta: {{$receta->titulo}} </h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{route( 'recetas.update',['receta' => $receta->id])}}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="titulo">
                        Titulo de la receta:
                    </label>
                    <input class="form-control @error('titulo') is-invalid @enderror" {{--TODO: este es para resaltar el input si hay error --}}
                            type="text"
                            value="{{$receta->titulo}}"
                            name="titulo"
                            placeholder="Titulo Receta"
                           >
                            @error('titulo'){{-- esto es por si existe un error el la validacion --}}
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                </div>




                <div class="form-group">
                    <label for="category">Categoria</label>

                    <select name="categoria" id="category" class="form-control @error('categoria') is-invalid  @enderror">
                            <option value="">-Seleccione -</option>

                            @foreach ($categorias as $cate){{-- se hace asi porque solo en el controlador se uso un plock --}}
                                <option value="{{ $cate->id }}"  {{$receta->categoria_id == $cate->id ? 'selected' : ''}}> {{ $cate->nombre}} </option>
                            @endforeach
                    </select>

                        @error('categoria'){{-- esto es por si existe un error el la validacion --}}
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror


                </div>

                {{-- Parte de Trix editor --}}
                <div class="form-group">
                    <label for="preparar">Instrucciones</label>
                    <input id="preparar" type="hidden" name="preparar" value="{{ $receta->preparacion }}">
                    <trix-editor input="preparar"
                                class="form-control @error('preparar') is-invalid  @enderror"></trix-editor>

                    @error('preparar'){{-- esto es por si existe un error el la validacion --}}
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ingredientes">Ingredientes</label>
                    <input id="ingredientes" type="hidden" name="ingredientes" value="{{ $receta->preparacion  }}">
                    <trix-editor input="ingredientes"
                                class="form-control @error('ingredientes') is-invalid  @enderror"></trix-editor>

                    @error('ingredientes'){{-- esto es por si existe un error el la validacion --}}
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>


                <div class="mt-4">
                    <p>Imagen Actual</p>
                    <img src="/storage/{{$receta->imagen}}" alt="" width="250px">

                </div>
                {{-- Parte imagenes --}}
                <div class="form-group">
                    <label for="imagen"> Elige una imagenes  </label>
                        <input type="file"   id="imagen" name="imagen" class="form-control @error('imagen') is-invalid  @enderror" >

                        @error('imagen'){{-- esto es por si existe un error el la validacion --}}
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar recetas">
                </div>
            </form>
        </div>
    </div>


@endsection

@push('scripts')
{{-- !se tiene que poner defer y colocar una configuracion de vue en public/js/app para que funcione el trixt --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"  defer integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
