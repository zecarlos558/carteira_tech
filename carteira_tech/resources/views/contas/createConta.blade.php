<x-div.main>
    @section('title','Cadastro Conta')
    @slot('tituloCentral')
    CADASTRO CONTA
    @endslot
    <x-div.principal>
        @slot('titulo')
            Preencha os dados do Conta
        @endslot
        <x-div.form action="{{ route('storeConta') }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ old('nome') }}" name="nome" id="nome" placeholder="Nome da Conta" />

            <x-label.label class="form-label" for="valor">Valor de abertura:</x-label.label>
            <x-input.number value="" name="valor" id="valor" placeholder="Valor da Conta" />

            <x-label.label for="tipo" >Tipo da Conta:</x-label.label>
            <x-input.select id="tipo" name="tipo" >
                <x-input.option value="">Selecione o tipo da Conta</x-input.option>
                @foreach ($tipos as $tipo)
                <x-input.option value="{{$tipo->id}}" >{{$tipo->nome}}</x-input.option>
                @endforeach
            </x-input.select>

            @slot('rodape')
                <x-button.button type="submit" icon='salvar' >Cadastrar Conta</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
