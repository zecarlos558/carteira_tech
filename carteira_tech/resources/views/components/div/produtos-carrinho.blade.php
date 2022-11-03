@if (isset($produtos['itens'][0]->id))
    <h2 style="text-align: center;" >Itens</h2>
    <x-div.table>
        <x-table.thead>
            <x-table.tr>
                <x-table.th scope="col">#</x-table.th>
                <x-table.th scope="col">Nome</x-table.th>
                <x-table.th scope="col">Preço(Un)</x-table.th>
                <x-table.th scope="col">QTD</x-table.th>
                <x-table.th scope="col">Desc.</x-table.th>
                <x-table.th scope="col">Total</x-table.th>
                @if (($produtos->carrinho == 'sim'))
                <x-table.th scope="col">Ações</x-table.th>
                @endif
            </x-table.tr>
        </x-table.thead>
        <x-table.tbody>
            @foreach ($produtos['itens'] as $produto)
                <x-table.tr>
                    <x-table.th scope="row">{{ $loop->index + 1 }}</x-table.th>
                    <x-table.td>{{ $produto->produto->nome }}</x-table.td>
                    @if ($produtos->tipoMovimento == 'saida')
                        <x-table.td>{{ $produto->produto->precoSaida }}</x-table.td>
                    @elseif ($produtos->tipoMovimento == 'entrada')
                        <x-table.td>{{ $produto->produto->precoEntrada }}</x-table.td>
                    @endif
                    <x-table.td>{{ $produto->quantidadeItem }}</x-table.td>
                    <x-table.td>{{ $produto->descontoItem }}</x-table.td>
                    <x-table.td>{{ $produto->total}} R$</x-table.td>

                    @if ($produtos->carrinho == 'sim')
                        @if ($produtos->tipoMovimento == 'saida')
                            <x-table.td-button>
                                <x-div.button>
                                    <x-div.form action="{{ route('destroyProdutoCarrinhos', $produto->id) }}" id="formButtons"
                                        method="POST">
                                        @slot('botao')
                                            <x-button.button type="submit" class="btn-danger delete-btn" icon='deletar'>Deletar
                                            </x-button.button>
                                        @endslot
                                    </x-div.form>
                                </x-div.button>
                            </x-table.td-button>
                        @elseif ($produtos->tipoMovimento == 'entrada')
                            <x-table.td-button>
                                <x-div.button>
                                    <x-div.form action="{{ route('destroyProdutoCarrinhosEntrada', $produto->id) }}" id="formButtons"
                                        method="POST">
                                        @slot('botao')
                                            <x-button.button type="submit" class="btn-danger delete-btn" icon='deletar'>Deletar
                                            </x-button.button>
                                        @endslot
                                    </x-div.form>
                                </x-div.button>
                            </x-table.td-button>
                        @endif

                    @endif

                </x-table.tr>
            @endforeach
        </x-table.tbody>
    </x-div.table>
@else

@endif
