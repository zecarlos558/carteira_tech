<x-div.main>
    @section('head')
    <!-- Scripts Locais -->
    <script src="/js/multiselect-dropdown.js" ></script>
    <!-- Scripts Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    @endsection

    @slot('tituloCentral')
        {{@$tituloCentral}}
    @endslot
{{--
    <x-div.titulo-header>
        @slot('titulo')
            {{ $titulo }}
        @endslot
        @isset($botao)
            @slot('botao')
                {{ $botao }}
            @endslot
        @endisset
    </x-div.titulo-header>
--}}
    {{$slot}}
</x-div.main>
