<x-div.main>
    @section('title','Cadastro Transação')
    @slot('tituloCentral')
    CADASTRO TRANSAÇÃO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Preencha os dados da Transação - Suprimento
        @endslot
        <x-div.form action="{{ route('updateMovimentoRenda', $movimento->id) }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ $movimento->nome }}" name="nome" id="nome" placeholder="Nome do Usuário" />

            <x-div.row>
                <x-div.col>
                    <x-label.label class="form-label" for="valor">Valor da Transação:</x-label.label>
                    <div class="input-group">
                        <x-label.span class="input-group-text" id="span_suprimento">+RS</x-label.span>
                        <x-input.number value="{{ $movimento->valor }}" name="valor" id="valor" placeholder="Valor do Movimento" />
                    </div>
                </x-div.col>
                <x-div.col>
                    <x-label.label for="data" class="form-label">Data da Renda</x-label.label>
                    <x-input.date id="data" name="data" value="{{ $movimento->data ? date('Y-m-d', strtotime($movimento->data)) : date('Y-m-d') }}"></x-input>
                </x-div.col>
            </x-div.row>

            <x-div.row>
                <x-div.col>
                    <x-label.label for="conta" >Tipo da Conta:</x-label.label>
                    <x-input.select id="conta" name="conta" >
                        <x-input.option value="">Selecione a conta</x-input.option>
                        @foreach ($tipo_contas as $key => $contas)
                        <optgroup label="{{$key}}">
                            @foreach ($contas as $conta)
                                <x-input.option value="{{$conta->id}}" other="{{ ($conta->id == $movimento->conta->id) ? 'selected' : '' }}">{{$conta->nome}}</x-input.option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </x-input.select>
                </x-div.col>
                <x-div.col>
                    <x-label.label for="categoria" >Tipo de Categoria:</x-label.label>
                    <x-input.select id="categoria" name="categoria" >
                        <x-input.option value="">Selecione a Categoria</x-input.option>
                        @foreach ($grupo_categorias as $key => $categorias)
                            <optgroup label="{{$key}}">
                                @foreach ($categorias as $categoria)
                                    <x-input.option value="{{$categoria->id}}" other="{{ ($categoria->id == $movimento->categoria->id) ? 'selected' : '' }}">{{$categoria->nome}}</x-input.option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </x-input.select>
                </x-div.col>
            </x-div.row>

            <x-div.input>
                <x-label.label for="descricao">Descrição:</x-label.label>
                <x-input.textarea name="descricao" rows="5" id="descricao" placeholder="Digite a descrição do produto">{{ $movimento->descricao }}</x-input.textarea>
            </x-div.input>

            @slot('rodape')
                <x-button.button type="submit" icon='salvar' >Cadastrar Transação</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
