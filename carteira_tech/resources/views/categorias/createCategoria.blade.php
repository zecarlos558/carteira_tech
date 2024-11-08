<x-div.main>
    @section('title','Cadastro Categoria')
    @slot('tituloCentral')
    CADASTRO CATEGORIA
    @endslot
    <x-div.principal>
        @slot('titulo')
            Preencha os dados da Categoria
        @endslot
        <x-div.form action="{{ route('storeCategoria') }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot

            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ old('nome') }}" name="nome" id="nome" placeholder="Nome da Categoria" />

            <x-label.label for="grupo" >Tipo de Grupo:</x-label.label>
            <x-input.select id="grupo" name="grupo" >
                <x-input.option value="">Selecione o grupo</x-input.option>
                @foreach ($grupos as $grupo)
                    <x-input.option value="{{$grupo->id}}" >{{$grupo->nome}}</x-input.option>
                @endforeach
            </x-input.select>

            @slot('rodape')
                <x-button.button type="submit" icon='salvar' >Cadastrar Categoria</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
