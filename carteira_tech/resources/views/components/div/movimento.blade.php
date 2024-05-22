@if (count(@$movimentos))


    <h2 style="text-align: center;" >Movimentos</h2>
    <x-div.table>
        <x-table.thead>
            <x-table.tr>
                <x-table.th scope="col">#</x-table.th>
                <x-table.th scope="col">Valor Pago</x-table.th>
                @if ($movimentos[0]->dataMovimentoParcela != null)
                <x-table.th scope="col">Valor Parcela</x-table.th>
                <x-table.th scope="col">Status</x-table.th>
                @else
                <x-table.th scope="col">Usuario</x-table.th>
                <x-table.th scope="col">Usuario</x-table.th>
                @endif
                <x-table.th scope="col">Data</x-table.th>
                <x-table.th scope="col">Ações</x-table.th>
            </x-table.tr>
        </x-table.thead>

    <x-table.tbody>
        @foreach ($movimentos as $movimento)
            <x-table.tr>
                <x-table.th scope="row">{{ $loop->index + 1 }}</x-table.th>
                <x-table.td>{{ $movimento->valor }}</x-table.td>
                @if ($movimento->dataMovimentoParcela != null)
                <x-table.td>{{ $movimento->valorParcela }}</x-table.td>
                <x-table.td>
                    @component('componentes.statusVenda')
                    {{$movimento->status}}
                    @endcomponent
                </x-table.td>
                <x-table.td>{{ formatoData($movimento->dataMovimentoParcela) }}</x-table.td>
                @else
                <x-table.td>{{ $movimento->user_id_create }}</x-table.td>
                <x-table.td>{{ $movimento->user_id_update }}</x-table.td>
                <x-table.td>{{ formatoData($movimento->created_at) }}</x-table.td>
                @endif
                <x-table.td-button>
                    <x-div.button>
                        @if ($movimento->dataMovimentoParcela != null)
                        <x-button.a class="btn-info edit-btn" href="{{ route($movimentos->rota['editParcela'], $movimento->id) }}" icon="editar" >Pagar</x-button.a>
                        @else
                        <x-button.a class="btn-info edit-btn" href="{{ route($movimentos->rota['edit'], $movimento->id) }}" icon="editar" >Editar</x-button.a>
                        @endif
                        <x-div.form action="{{ route($movimentos->rota['destroy'], $movimento->id) }}" id="formButtons"
                            method="POST">
                            @slot('metodo')
                                DELETE
                            @endslot
                            @slot('botao')
                                <x-button.button type="submit" class="btn-danger delete-btn" icon='deletar'>Deletar</x-button.button>
                            @endslot
                        </x-div.form>
                    </x-div.button>
                </x-table.td-button>
            </x-table.tr>
        @endforeach
    </x-table.tbody>
    </x-div.table>
@else
    <h4>Não há registros de Movimentos</h4>
@endif
