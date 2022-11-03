<x-div.main>
    @section('title','Cadastro Transação')
    @slot('tituloCentral')
    CADASTRO TRANSAÇÃO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Preencha os dados da Transação
        @endslot
        <x-div.form action="{{ route('updateMovimento', $movimento->id) }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ $movimento->nome }}" name="nome" id="nome" placeholder="Nome do Usuário" />

            <x-label.label class="form-label" for="valor">Valor da Transação:</x-label.label>
            <x-input.number value="{{ $movimento->valor }}" name="valor" id="valor" placeholder="Valor do Movimento" />

            <x-label.label for="plano" class="form-label">Tipo da Transação:</x-label.label>
            <x-input.radio class="form-check-input" id="radio1" name="tipo" value="gasto">Sim</x-input.radio>
            <x-input.radio class="form-check-input" id="radio2" name="tipo" value="renda" checked>Não</x-input.radio>

            <x-label.label for="conta" >Tipo da Conta:</x-label.label>
            <x-input.select id="conta" name="conta" >
                @foreach ($contas as $conta)
                @if ($movimento->conta == $conta->id)
                <x-input.option selected value="{{$conta->id}}" >{{$conta->nome}}</x-input.option>
                @else
                <x-input.option value="{{$conta->id}}" >{{$conta->nome}}</x-input.option>
                @endif
                 @endforeach
            </x-input.select>

            <x-label.label for="categoria" >Tipo de Categoria:</x-label.label>
            <x-input.select id="categoria" name="categoria" >
                @foreach ($categorias as $categoria)
                @if ($movimento->categoria == $conta->id)
                <x-input.option selected value="{{$categoria->id}}" >{{$categoria->nome}}</x-input.option>
                @else
                <x-input.option value="{{$categoria->id}}" >{{$categoria->nome}}</x-input.option>
                @endif
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
