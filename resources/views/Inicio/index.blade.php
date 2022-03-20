@extends('layouts.app')

@section('estilos')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('hero')

    <div class="hero-categorias">
        <form action="{{route('buscar.search')}}" class="container h-100" >
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Encuentra una Receta </p>
                    <input type="search" class="form-control" placeholder="Buscar receta" name="buscar">
                </div>
            </div>

        </form>
    </div>



@endsection
@section('content')

<section class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase  mb-4">Últimas recetas</h2>

        {{-- contenedor de carousel --}}
        <div class="owl-carousel owl-theme">
            @foreach ($recetas_nuevas  as $nueva)
            <div class="card">
                    <img src="/storage/{{$nueva->imagen}}"  class="card-img-top"  alt="imagen-receta">

                    <div class="card-body">
                        <h3>{{$nueva->titulo}}</h3>

                        {{-- Lo que hace esto es que convierte las etiquetas html en texto --}}
                        {{-- Str::words corta un texto en un determinado nuero de palabras y Str::limit lo hace con letras --}}
                        <p> {{  Str::words(strip_tags( $nueva->preparacion), 20 )  }} </p>
                        <a href=" {{route('recetas.show',['receta'=> $nueva->id ])}} " class="btn btn-primary d-block font-weight-bold text-uppercase">Ver receta</a>
                    </div>
                </div>

            @endforeach
</div>

    <div class="container">
                    {{--str_replace sirve para quitar el guion que trae el nombre de la categoria    --}}
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Recetas mas votadas </h2>
        <div class="row">
            @foreach($votadas as $receta)
                @include('includes.recetaInicio')
            @endforeach
        </div>
    </div>

        {{-- Parte donde se iran mostrando las recetas por categoria --}}

        {{-- el key es el nombre de las categorias --}}
        @foreach($recetas as $key => $grupo)
            <div class="container">
                                                            {{--str_replace sirve para quitar el guion que trae el nombre de la categoria    --}}
                <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{ str_replace('-',' ',$key)}} </h2>
                <div class="row">
                    @foreach($grupo as $Recetas)
                        @foreach($Recetas as $receta)
                            @include('includes.recetaInicio')

                        @endforeach
                    @endforeach
                </div>
            </div>
        @endforeach

    </section>
@endsection
