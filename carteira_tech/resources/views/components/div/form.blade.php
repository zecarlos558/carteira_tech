<form {{ $attributes->merge(['class' => '']) }} id="{{@$id}}" action="{{@$action}}" method="{{@$method}}" autocomplete="off">
    @isset($metodo)
        @if (strcasecmp($metodo, "POST") == 0)
        @method('POST')
        @elseif (strcasecmp($metodo, "PUT") == 0)
        @method('PUT')
        @elseif (strcasecmp($metodo, "GET") == 0)
        @method('GET')
        @elseif (strcasecmp($metodo, "DELETE") == 0)
        @method('DELETE')
        @endif
    @endisset
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

    @if (isset($botao))
        {{$botao}}
    @else

    <x-erros_request></x-erros_request>
    <x-div.card>
        @isset($header)
            @slot('header')
                {{$header}}
            @endslot
        @endisset
        @slot('corpo')
        {{$slot}}
        @endslot
        @isset($rodape)
            @slot('rodape')
            {{$rodape}}
            @endslot
        @endisset
    </x-div.card>
    @endif


</form>
