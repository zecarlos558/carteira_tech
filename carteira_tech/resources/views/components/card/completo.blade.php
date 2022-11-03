<div class="card">
    @isset($header)
    <div class="card-header">
        <h4>{{$header}}</h4>
        @isset($subtituloHeader)
        <h6 class="card-subtitle mb-2 text-muted ">{{$subtituloHeader}}</h6>
        @endisset
    </div>
    @endisset
    @isset($corpo)
        <div class="card-body">
            @isset($titulo)
            <h4 class="card-title">{{$titulo}}</h4>
            @endisset
            @isset($subtitulo)
            <h6 class="card-subtitle mb-2 text-muted ">{{$subtitulo}}</h6>
            @endisset
            <p class="card-text">{{$corpo}}</p>
        </div>
    @endisset
    @isset($rodape)
    <div class="card-footer text-muted">
        {{$rodape}}
    </div>
    @endisset
</div>
