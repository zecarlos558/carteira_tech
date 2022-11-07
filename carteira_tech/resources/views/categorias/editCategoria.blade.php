<x-div.main>
    @section('title','Editar Categoria')
    @slot('tituloCentral')
    EDITAR CATEGORIA
    @endslot
    <x-div.principal>
        @slot('titulo')
            Edite os dados do Categoria
        @endslot
        <x-div.form action="{{ route('updateCategoria', $categoria->id) }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ $categoria->nome }}" name="nome" id="nome" placeholder="Nome da Categoria" />

            @slot('rodape')
                <x-button.button type="submit" icon='salvar' >Editar Categoria</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
