<x-div.main>
    @section('title','Cadastro Grupo')
    @slot('tituloCentral')
    CADASTRO GRUPO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Preencha os dados do Grupo
        @endslot
        <x-div.form action="{{ route('storeGrupo') }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ old('nome') }}" name="nome" id="nome" placeholder="Nome do Grupo" />

            @slot('rodape')
                <x-button.button type="submit" icon='salvar' >Cadastrar Grupo</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
