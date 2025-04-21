<div id="search-container" class="d-flex justify-content-start">
    <form href="" autocomplete="off">
        <x-div.row>
            <x-div.col type="auto">
                <div class="input-group">
                    <span class="input-group-text">
                        <ion-icon name="search-outline"></ion-icon>
                    </span>
                    <input type="text" id="inputPesquisa" name="pesquisa" class="form-control"
                        onkeyup="FuncaoPesquisaTabela()" placeholder="Procurar">
                </div>
            </x-div.col>
            <x-div.col type="auto">
                <div class="input-group">
                    <x-input.select id="offset" name="offset">
                        <x-input.option value="todos">Todos</x-input.option>
                        @foreach ($offset_options as $item)
                            @if ($item == request('offset') || $item == request('offset_busca') || $item == session()->get('offset'))
                                <x-input.option value="{{ $item }}" selected>{{ $item }} </x-input.option>
                            @else
                                <x-input.option value="{{ $item }}">{{ $item }}</x-input.option>
                            @endif
                        @endforeach
                    </x-input.select>
                    <x-button.button class="btn-success" icon="listar"></x-button.button>
                </div>
            </x-div.col>
        </x-div.row>
    </form>
</div>
