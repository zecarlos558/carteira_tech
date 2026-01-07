<x-div.main>
    @section('title', 'Relatório')
    @slot('tituloCentral')
        Relatório Financeiro Personalizado
    @endslot
    <x-div.form action="{{ route('storeRelatorio') }}" method="post" target="_blank">
        @slot('header')
            Consultar Dados
        @endslot
        <x-div.row>
            <x-div.col type="-sm-auto col-md-3">
                <x-label.label for="opcao_data">Tipo da data:</x-label.label>
                <x-input.select id="opcao_data" name="opcao_data" onChange="selecionaData();">
                    <x-input.option value="mensal">Mensal</x-input.option>
                    <x-input.option value="personalizado">Personalizado</x-input.option>
                </x-input.select>
            </x-div.col>
            <x-div.col type="-sm-auto col-md-9" id="mensal">
                <x-label.label class="input-group" icon='calendario'>Data Mês</x-label.label>
                <x-input.date-month id="data" name="data" value="{{ date('Y-m') }}"></x-input.date-month>
            </x-div.col>
            <x-div.col type="-sm-auto col-md-9" id="personalizado" style="display: none;">
                <x-div.row>
                    <x-div.col>
                        <x-label.label icon='calendario'>Data Inicio</x-label.label>
                        <x-input.date-month id="dataInicio" name="dataInicio" value="{{ date('Y-m') }}">
                        </x-input.date-month>
                    </x-div.col>
                    <x-div.col>
                        <x-label.label icon='calendario'>Data Fim</x-label.label>
                        <x-input.date-month id="dataFim" name="dataFim" value="{{ date('Y-m') }}">
                        </x-input.date-month>
                    </x-div.col>
                </x-div.row>
            </x-div.col>
            <x-div.col type="-sm-auto col-md-6">
                <x-label.label>Categoria</x-label.label>
                <x-input.select id="categoria_id" name="categoria_id">
                    <x-input.option value="">Todas</x-input.option>
                    @foreach ($grupo_categorias as $key => $categorias)
                        <optgroup label="{{$key}}">
                            @foreach ($categorias as $categoria)
                                <x-input.option value="{{$categoria->id}}">{{$categoria->nome}}</x-input.option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </x-input.select>
            </x-div.col>
            <x-div.col type="-sm-auto col-md-3">
                <x-label.label>Conta</x-label.label>
                <x-input.select id="conta_id" name="conta_id" >
                    <x-input.option value="">Todas</x-input.option>
                    @foreach ($tipo_contas as $key => $contas)
                    <optgroup label="{{$key}}">
                        @foreach ($contas as $conta)
                            <x-input.option value="{{$conta->id}}">{{$conta->nome}}</x-input.option>
                        @endforeach
                    </optgroup>
                    @endforeach
                </x-input.select>
            </x-div.col>
            <x-div.col type="-sm-auto col-md-3">
                <x-label.label>Tipo</x-label.label>
                <x-input.select id="tipo" name="tipo">
                    <x-input.option value="">Todos</x-input.option>
                    @foreach ($tipo_movimentos as $tipo_movimento)
                        <x-input.option value="{{$tipo_movimento['codigo']}}">{{$tipo_movimento['descricao']}}</x-input.option>
                    @endforeach
                </x-input.select>
            </x-div.col>
            <x-div.col type="-sm-auto col-md-6">
                <x-label.label>Descrição Movimento</x-label.label>
                <x-input.text type="text" value="" placeholder="Descrição de movimento" name="descricao" id="descricao"></x-input.text>
            </x-div.col>
            <x-div.col type="-sm-auto col-md-3">
                <x-label.label>Exibe Transações</x-label.label>
                <x-input.radio id="exibe_transacao_true" name="exibe_transacao" value="true">Sim</x-input.radio>
                <x-input.radio id="exibe_transacao_false" name="exibe_transacao" value="false" checked>Não</x-input.radio>
            </x-div.col>
        </x-div.row>
        @slot('rodape')
            <x-button.button type="submit" class="btn-primary" icon='pesquisar'>Gerar Relatório</x-button.button>
        @endslot
    </x-div.form>
    <script>
        $(document).ready(function() {
            opcao_data = "mensal";
            if (opcao_data) {
                $('#opcao_data').val(opcao_data).trigger('change');
            }
        });
    </script>
</x-div.main>
