<x-div.main>
    @section('title','Cadastro Tipo')
    @slot('tituloCentral')
    CADASTRO TIPO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Preencha os dados do Tipo
        @endslot
        <x-div.form action="{{ route('storeTipo') }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ old('nome') }}" name="nome" id="nome" placeholder="Nome da Tipo" />
            @slot('rodape')
                <x-button.button type="submit" class="btn-primary" icon='salvar' >Cadastrar Tipo</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
