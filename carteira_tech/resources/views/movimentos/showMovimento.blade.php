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
                        <x-table.td-show>ID:</x-table.td-show>
                        <x-table.td>{{ $movimento->id }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Nome:</x-table.td-show>
                        <x-table.td>{{ $movimento->nome }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Valor:</x-table.td-show>
                        <x-table.td>{{ $movimento->valor }}</x-table.td>
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
                        <x-table.td-show>Data de Criação:</x-table.td-show>
                        <x-table.td>{{ $movimento->created_at }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Data de Atualização:</x-table.td-show>
                        <x-table.td>{{ $movimento->updated_at }}</x-table.td>
                    </x-table.tr>
                </x-table.tbody>
            </x-div.table-show>
            @slot('rodape')
            <x-div.button>
                <x-button.a href="{{ route('editMovimento', $movimento->id)}}" class="btn-info edit-btn" icon='editar'>Editar</x-button.a>
                <x-div.form action="{{ route('deleteMovimento', $movimento->id) }}" id="formButtons" method="POST" >
                    @slot('metodo')
                        DELETE
                    @endslot
                    @slot('botao')
                        <x-button.button type="submit" class="btn-danger delete-btn" icon='deletar'>Deletar</x-button.button>
                    @endslot
                </x-div.form>
            </x-div.button>
            @endslot
        </x-div.show>
    </x-div.principal>
</x-div.main>

