<x-div.main>
    @section('title', 'Cores')
    @slot('tituloCentral')
        CORES
    @endslot
    <x-div.principal>
        @slot('titulo')
        Cores
        @endslot
        <x-div.form action="{{ route('storeColor') }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-div.row>
                <h2 class="pb-2 border-bottom">Body</h2>
                <x-div.col>
                    <div>
                        <input type="color" id="body" name="body"
                                value="#e66465">
                        <label for="body">Body Background</label>
                    </div>
                </x-div.col>
                <x-div.col>
                    <div>
                        <input type="color" id="bodyText" name="bodyText"
                                value="#f6b73c">
                        <label for="bodyText">Body Color</label>
                    </div>
                </x-div.col>
            </x-div.row>
            <x-div.row>
                <h2 class="pb-2 border-bottom">Head</h2>
                <x-div.col>
                    <div>
                        <input type="color" id="head" name="head"
                               value="#e66465">
                        <label for="head">Head Background</label>
                    </div>
                </x-div.col>
                <x-div.col>
                    <div>
                        <input type="color" id="headText" name="headText"
                                value="#f6b73c">
                        <label for="headText">Head Color</label>
                    </div>
                </x-div.col>
            </x-div.row>
            <x-div.row>
                <h2 class="pb-2 border-bottom">Titulo</h2>
                <x-div.col>
                    <div>
                        <input type="color" id="titulo" name="titulo"
                               value="#e66465">
                        <label for="titulo">Titulo Background</label>
                    </div>
                </x-div.col>
                <x-div.col>
                    <div>
                        <input type="color" id="tituloText" name="tituloText"
                                value="#f6b73c">
                        <label for="tituloText">Titulo Color</label>
                    </div>
                </x-div.col>
            </x-div.row>

            @slot('rodape')
                <x-div.button>
                    <x-button.button class="btn-success" type="submit" icon="salvar">Salvar Cores
                    </x-button.button>
                    <x-button.button class="btn-primary" type="button" icon="editar" onclick="corSistema()" >Editar Cores
                    </x-button.button>
                </x-div.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
