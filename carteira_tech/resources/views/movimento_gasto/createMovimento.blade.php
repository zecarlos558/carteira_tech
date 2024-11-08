<x-div.main>
    @section('title','Cadastro Transação')
    @slot('tituloCentral')
    CADASTRO TRANSAÇÃO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Preencha os dados da Transação - Retirada
        @endslot
        <x-div.form action="{{ route('storeMovimentoGasto') }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ old('nome') }}" name="nome" id="nome" placeholder="Nome do Movimento" />

            <x-div.row>
                <x-div.col>
                    <x-label.label class="form-label" for="valor">Valor da Transação:</x-label.label>
                    <div class="input-group">
                        <x-label.span class="input-group-text" id="span_retirada">-RS</x-label.span>
                        <x-input.number value="{{ old('valor') }}" name="valor" id="valor" placeholder="Valor do Movimento" />
                    </div>
                </x-div.col>
                <x-div.col>
                    <x-label.label for="data" class="form-label">Data da Despesa</x-label.label>
                    <x-input.date id="data" name="data" value="{{ date('Y-m-d') }}"></x-input>
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
                                <x-input.option value="{{$conta->id}}" >{{$conta->nome}}</x-input.option>
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
                                    <x-input.option value="{{$categoria->id}}">{{$categoria->nome}}</x-input.option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </x-input.select>
                </x-div.col>
            </x-div.row>

            <x-div.input>
                <x-label.label for="descricao">Descrição:</x-label.label>
                <x-input.textarea name="descricao" rows="5" id="descricao" placeholder="Digite a descrição do produto">
                    {{ old('descricao') }}</x-input.textarea>
            </x-div.input>

            @slot('rodape')
                <x-button.button type="submit" icon='salvar' >Cadastrar Transação</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
