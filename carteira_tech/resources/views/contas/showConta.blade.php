<x-div.main >
    @section('title','Detalhe Conta')
    @slot('tituloCentral')
    DETALHE DA CONTA
    @endslot
    <x-div.principal>
        @slot('titulo')
            Informações da Conta
        @endslot
        <x-div.show>
            <x-div.table-show>
                <x-table.tbody>
                    <x-table.tr>
                        <x-table.td-show>Nome:</x-table.td-show>
                        <x-table.td>{{ $conta->nome }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Valor:</x-table.td-show>
                        <x-table.td>{{ $conta->getValor()}} R$</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Tipo da Conta:</x-table.td-show>
                        <x-table.td>{{ $conta->tipo->nome }}</x-table.td>
                    </x-table.tr>
                </x-table.tbody>
            </x-div.table-show>
            @slot('rodape')
            <x-div.button>
                <x-button.a href="{{ route('editConta', $conta->id)}}" class="btn-info edit-btn" icon='editar'>Editar</x-button.a>
                <x-div.form action="{{ route('deleteConta', $conta->id) }}" id="formButtons" method="POST" >
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

