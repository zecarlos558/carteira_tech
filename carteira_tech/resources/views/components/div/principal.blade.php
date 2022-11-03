<div {{ $attributes->merge(['class' => '']) }} id="{{ $id ? $id : '' }}">

    {{-- Outra Formtação
    @isset($titulo)
        <x-card.header>
            {{$titulo}}
        </x-card.header>
    @endisset

    @isset($rodape)
        <x-card.footer>
            {{$rodape}}
        </x-card.footer>
    @endisset --}}

    @isset($titulo)
        <x-div.titulo-header>
            @slot('titulo')
                {{ $titulo }}
            @endslot
            @isset($rodape)
                @slot('botao')
                    {{ $rodape }}
                @endslot
            @endisset
        </x-div.titulo-header>
    @endisset
    {{ $slot }}
</div>
