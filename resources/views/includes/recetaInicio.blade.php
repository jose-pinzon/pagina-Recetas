<div class="col-md-4 mt-4">
        <div class="card shadow">
            <img src="/storage/{{ $receta->imagen }}" class="card-img-top" alt="imagen">
            <div class="card-body">
                <h3 class="card-title">{{$receta->titulo}} </h3>

                <div class="meta-receta d-flex justify-content-between">
                    @php
                        $fecha = $receta->created_at
                    @endphp
                        <p class="text-primary fecha font-weight-bold">
                            <moment fecha="{{ $fecha }}"></moment>
                        </p>

                        <p>
                            {{count($receta->likesRecibidos)}} les gusto
                        </p>
                </div>
                    <p> {{  Str::words(strip_tags( $receta->preparacion), 20 )  }} </p>
                    <a href="{{route('recetas.show',['receta' => $receta->id])}}" class="btn btn-primary d-block btn-receta">Ver</a>
            </div>
        </div>
    </div>
