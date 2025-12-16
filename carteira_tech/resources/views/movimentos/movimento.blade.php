<x-div.table-list>
    @section('title', 'Movimentos')
    @slot('tituloCentral')
        MOVIMENTOS
    @endslot

    @slot('titulo')
        Lista de Movimentos - {{ ucfirst(formataDataRelatorio(@$parametros['data'])) }}
    @endslot
    <h5>{{ verificaCountObjeto($movimentos) }}</h5>
    @slot('botao')
        <x-div.button>
            <x-button.button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" icon="criar">Transação
            </x-button.button>
            <x-button.a href="#filtro" data-bs-toggle="collapse" icon='filtrar'>Filtrar</x-button.a>
            <ul class="dropdown-menu" id="MenuOpcao">
                <li>
                    <x-button.a class="dropdown-item" href="{{ route('createMovimentoRenda') }}">+R$ Entrada</x-button.a>
                </li>
                <li>
                    <x-button.a class="dropdown-item" href="{{ route('createMovimentoGasto') }}">-R$ Saida</x-button.a>
                </li>

            </ul>
        </x-div.button>
    @endslot
    @slot('filtro')
        <x-div.principal id="filtro" class="collapse mt-2">
            <form autocomplete="off">
                <x-input.text id="offset_busca" name="offset_busca" value="{{@$parametros['offset'] ?? session()->get('offset')}}" style="display: none;"></x-input.text>
                <x-div.row>
                    <x-div.col type="auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='movimento'>Movimento</x-label.span>
                            <x-input.text type="text" value="{{ @$parametros['descricao'] }}" placeholder="Pesquisar"
                                name="descricao" id="descricao"></x-input.text>
                        </div>
                    </x-div.col>
                    <x-div.col type="auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='calendario'>Data</x-label.span>
                            <x-input.date-month id="data" name="data" value="{{ date('Y-m', strtotime(@$parametros['data'])) }}">
                            </x-input.date-month>
                        </div>
                    </x-div.col>
                    <x-div.col type="auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='conta'>Conta</x-label.span>
                            <x-input.select id="conta_id" name="conta_id" >
                                <x-input.option value="">Selecione a conta</x-input.option>
                                @foreach ($tipo_contas as $key => $contas)
                                <optgroup label="{{$key}}">
                                    @foreach ($contas as $conta)
                                        @if (@$parametros['conta_id'] == $conta->id)
                                            <x-input.option value="{{$conta->id}}" selected>{{$conta->nome}}</x-input.option>
                                        @else
                                            <x-input.option value="{{$conta->id}}">{{$conta->nome}}</x-input.option>
                                        @endif
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </x-input.select>
                        </div>
                    </x-div.col>
                </x-div.row>
                <x-div.row>

                    <x-div.col type="auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='categoria'>Categoria</x-label.span>
                            <x-input.select id="categoria_id" name="categoria_id">
                                <x-input.option value="">Selecione a categoria</x-input.option>
                                @foreach ($grupo_categorias as $key => $categorias)
                                    <optgroup label="{{$key}}">
                                        @foreach ($categorias as $categoria)
                                            @if (@$parametros['categoria_id'] == $categoria->id)
                                                <x-input.option value="{{$categoria->id}}" selected>{{$categoria->nome}}</x-input.option>
                                            @else
                                                <x-input.option value="{{$categoria->id}}">{{$categoria->nome}}</x-input.option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </x-input.select>
                        </div>
                    </x-div.col>
                    <x-div.col type="auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='tipo'>Tipo</x-label.span>
                            <x-input.select id="tipo" name="tipo">
                                <x-input.option value="">Selecione o tipo</x-input.option>
                                @foreach ($tipo_movimentos as $tipo_movimento)
                                    @if (@$parametros['tipo'] == $tipo_movimento['codigo'])
                                        <x-input.option value="{{$tipo_movimento['codigo']}}" selected>{{$tipo_movimento['descricao']}}</x-input.option>
                                    @else
                                        <x-input.option value="{{$tipo_movimento['codigo']}}">{{$tipo_movimento['descricao']}}</x-input.option>
                                    @endif
                                @endforeach
                            </x-input.select>
                        </div>
                    </x-div.col>
                </x-div.row>
                <x-div.button class="mt-2">
                    <x-button.button type="submit" icon='pesquisar'>Resultado</x-button.button>
                    <x-button.a href="{{ route('indexMovimento') }}" class="btn btn-dark" icon='limpar'>Limpar
                        Filtros</x-button.a>
                </x-div.button>
            </form>
        </x-div.principal>
    @endslot
    <x-div.table>
        <x-table.thead>
            <x-table.tr>
                <x-table.th scope="col">#</x-table.th>
                <x-table.th scope="col">Nome</x-table.th>
                @if (session()->get('device'))
                <x-table.th scope="col">Valor</x-table.th>
                @else
                <x-table.th scope="col">Data</x-table.th>
                <x-table.th scope="col">Valor</x-table.th>
                @endif
                <x-table.th scope="col">Categoria</x-table.th>
            </x-table.tr>
        </x-table.thead>
        <x-table.tbody>
            @foreach ($movimentos as $movimento)
                <x-table.tr>
                    <x-table.th class="align-middle text-center" scope="row">{{ $loop->index + 1 }}</x-table.th>
                    <x-table.td>
                        <x-div.button>
                            @if ($movimento->tipo == 'suprimento')
                                <x-button.a class="btn-link btn-sm" href="{{ route('showMovimentoRenda', $movimento->id) }}">
                                    {{ $movimento->nome }}</x-button.a>
                            @else
                                <x-button.a class="btn-link btn-sm" href="{{ route('showMovimentoGasto', $movimento->id) }}">
                                    {{ $movimento->nome }}</x-button.a>
                            @endif
                        </x-div.button>
                    </x-table.td>
                    @if (session()->get('device'))
                    <x-table.td style="min-width: 100px;"> {{ formatarData($movimento->data) }} <br> R$ {{ $movimento->getValor() }} </x-table.td>
                    @else
                    <x-table.td> {{ formatarData($movimento->data) }} </x-table.td>
                    <x-table.td> R$ {{ $movimento->getValor() }} </x-table.td>
                    @endif
                    <x-table.td style="display: flex; padding-bottom: 0px;">{{ $movimento->categoria->nome }}
                    </x-table.td>
                    <x-table.td style="display: flex; padding-top: 0px;">
                        <x-status_movimento>{{ $movimento->tipo }}</x-status_movimento>
                    </x-table.td>
                </x-table.tr>
            @endforeach
        </x-table.tbody>
    </x-div.table>
    <x-card.footer>
        <x-div.row type="justify-content-around">
            <div class="col-auto">{{ count($movimentos) }} Transações</div>
            <div class="col-auto">R$ {{formatarNumero($movimentos->sum('total'))}}</div>
        </x-div.row>
    </x-card.footer>
</x-div.table-list>
<x-div.paginacao :dados="$movimentos"></x-div.paginacao>
