<x-card.header>
    <div class="row justify-content-between">
        <div class="col-auto mt-2">
            {{$titulo}}
        </div>
        <div class="col-auto mt-2">
            @isset($botao)
            {{$botao}}
            @endisset
        </div>
    </div>
</x-card.header>
