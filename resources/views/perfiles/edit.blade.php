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
    <h1 class="text-center">Editar Mi Perfil</h1>

    <div class="row justify-content-center mt-5">
            <div class="col-md-10 bg-white p-3">
                <form  action="{{route('perfil.update',['perfil' => $perfil->id ])}}"  method="POST" enctype="multipart/form-data">
                @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nombre">
                            Nombre
                        </label>
                        <input class="form-control @error('nombre') is-invalid @enderror"
                                type="text"
                                value="{{$perfil->usuario->name}}"
                                name="nombre"
                                id="nombre"
                                placeholder=" Jose ..."
                                >
                                @error('nombre')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                    </div>


                    <div class="form-group">
                        <label for="url">
                            sitio web
                        </label>
                        <input class="form-control @error('url') is-invalid @enderror"
                                type="text"
                                value="{{$perfil->usuario->pagina}}"
                                name="url"
                                id="url"
                                placeholder=" Jose ..."
                               >
                                @error('url')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                    </div>

                    <div class="form-group">
                        <label for="biografia">Bibiografia</label>
                        <input id="biografia" type="hidden" name="biografia"  value=" {{$perfil->biografia}} " >
                        <trix-editor input="biografia"
                                    class="form-control @error('biografia') is-invalid  @enderror"></trix-editor>

                        @error('biografia')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>


                    @if ($perfil->image)
                        <div class="mt-4">
                            <p>Imagen Actual</p>
                            <img src="/storage/{{$perfil->image}}" alt="" width="250px">
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="image"> tu imagen </label>
                            <input type="file"   id="image" name="image" class="form-control @error('image') is-invalid  @enderror" >

                            @error('image'){{-- esto es por si existe un error el la validacion --}}
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                    </div>

                        <input type="submit" class="btn btn-primary"  value="Guardar" >
                </form>
            </div>
    </div>

@endsection

@push('scripts')
{{-- !se tiene que poner defer y colocar una configuracion de vue en public/js/app para que funcione el trixt --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"  defer integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
