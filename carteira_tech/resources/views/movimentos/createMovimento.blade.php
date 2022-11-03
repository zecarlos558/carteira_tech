<x-div.main>
    @section('title','Cadastro Transação')
    @slot('tituloCentral')
    CADASTRO TRANSAÇÃO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Preencha os dados da Transação
        @endslot
        <x-div.form action="{{ route('storeMovimento') }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ old('nome') }}" name="nome" id="nome" placeholder="Nome do Usuário" />

            <x-label.label class="form-label" for="valor">Valor da Transação:</x-label.label>
            <x-input.number value="{{ old('valor') }}" name="valor" id="valor" placeholder="Valor do Movimento" />

            <x-label.label for="plano" class="form-label">Tipo da Transação:</x-label.label>
            <x-input.radio class="form-check-input" id="radio1" name="tipo" value="gasto">Sim</x-input.radio>
            <x-input.radio class="form-check-input" id="radio2" name="tipo" value="renda" checked>Não</x-input.radio>

            <x-label.label for="conta" >Tipo da Conta:</x-label.label>
            <x-input.select id="conta" name="conta" >
                <x-input.option value="">Selecione a conta</x-input.option>
                @foreach ($contas as $conta)
                <x-input.option value="{{$conta->id}}" >{{$conta->nome}}</x-input.option>
                @endforeach
            </x-input.select>

            <x-label.label for="categoria" >Tipo de Categoria:</x-label.label>
            <x-input.select id="categoria" name="categoria" >
                <x-input.option value="">Selecione a Categoria</x-input.option>
                @foreach ($categorias as $categoria)
                <x-input.option value="{{$categoria->id}}" >{{$categoria->nome}}</x-input.option>
                @endforeach
            </x-input.select>

            <x-div.input>
                <x-label.label for="descricao">Descrição:</x-label.label>
                <x-input.textarea name="descricao" rows="5" id="descricao" placeholder="Digite a descrição do produto">
                    {{ old('descricao') }}</x-input.textarea>
            </x-div.input>

            @slot('rodape')
                <x-button.button type="submit" class="btn-primary" icon='salvar' >Cadastrar Transação</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
