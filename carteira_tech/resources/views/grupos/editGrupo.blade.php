<x-div.main>
    @section('title','Editar Grupo')
    @slot('tituloCentral')
    EDITAR GRUPO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Edite os dados do Grupo
        @endslot
        <x-div.form action="{{ route('updateGrupo', $grupo->id) }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ $grupo->nome }}" name="nome" id="nome" placeholder="Nome do Grupo" />

            @slot('rodape')
                <x-button.button type="submit" icon='salvar' >Editar Grupo</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
