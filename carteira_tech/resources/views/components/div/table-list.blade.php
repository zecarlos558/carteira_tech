<x-div.main>
    @section('head')
    <!-- Scripts Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    @endsection

    @slot('tituloCentral')
        {{@$tituloCentral}}
    @endslot

    <x-div.titulo-header>
        @slot('titulo')
            {{ @$titulo }}
        @endslot
        @isset($botao)
            @slot('botao')
                {{ @$botao }}
            @endslot
        @endisset
    </x-div.titulo-header>

    <div class="row justify-content-between">
        <div class="col-auto">
            <x-div.center-search> Pesquisar </x-div.center-search>
        </div>
        <div class="col-auto">
            @isset($filtro)
            {{$filtro}}
            @endisset
        </div>
    </div>

    {{$slot}}
    <x-ordenar_tabela></x-ordenar_tabela>
</x-div.main>
