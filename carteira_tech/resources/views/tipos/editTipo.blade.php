<x-div.main>
    @section('title','Editar Tipo')
    @slot('tituloCentral')
    EDITAR TIPO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Edite os dados do Tipo
        @endslot
        <x-div.form action="{{ route('updateTipo', $tipo->id) }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ $tipo->nome }}" name="nome" id="nome" placeholder="Nome do Tipo" />

            @slot('rodape')
                <x-button.button type="submit" class="btn-primary" icon='salvar' >Editar Tipo</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
