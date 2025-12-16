<x-div.main >
    @section('title','Detalhe Transação')
    @slot('tituloCentral')
    DETALHE DA TRANSAÇÃO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Informações da Transação
        @endslot
        <x-div.show>
            <x-div.table-show>
                <x-table.tbody>
                    <x-table.tr>
                        <x-table.td-show>Nome:</x-table.td-show>
                        <x-table.td>{{ $movimento->nome }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Valor:</x-table.td-show>
                        <x-table.td>R$ {{ $movimento->getValor()}}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Tipo:</x-table.td-show>
                        <x-table.td>{{ $movimento->tipo }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Conta:</x-table.td-show>
                        <x-table.td>{{ $movimento->conta->nome }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Categoria:</x-table.td-show>
                        <x-table.td>{{ $movimento->categoria->nome }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Descrição:</x-table.td-show>
                        <x-table.td>{{ $movimento->descricao }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Data:</x-table.td-show>
                        <x-table.td>{{ $movimento->getData() }}</x-table.td>
                    </x-table.tr>
                </x-table.tbody>
            </x-div.table-show>
            @slot('rodape')
            <x-div.button>
                <x-button.a href="{{ route('editMovimentoRenda', $movimento->id)}}" class="btn-info edit-btn" icon='editar'>Editar</x-button.a>
                <x-div.form action="{{ route('deleteMovimentoRenda', $movimento->id) }}" id="formButtons" method="POST" >
                    @slot('metodo')
                        DELETE
                    @endslot
                    @slot('botao')
                        <x-button.button type="submit" icon='deletar'>Deletar</x-button.button>
                    @endslot
                </x-div.form>
            </x-div.button>
            @endslot
        </x-div.show>
    </x-div.principal>
</x-div.main>

