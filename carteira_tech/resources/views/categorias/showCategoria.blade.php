<x-div.main>
    @section('title', 'Detalhe Categoria')
    @slot('tituloCentral')
        DETALHE DA CATEGORIA
    @endslot
    <x-div.principal>
        @slot('titulo')
            Informações da Categoria
        @endslot
        <x-div.show>
            <x-div.table-show>
                <x-table.tbody>
                    <x-table.tr>
                        <x-table.td-show>ID:</x-table.td-show>
                        <x-table.td>{{ $categoria->id }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Nome:</x-table.td-show>
                        <x-table.td>{{ $categoria->nome }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Grupo:</x-table.td-show>
                        <x-table.td>{{ $categoria->grupos[0]->nome }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Data de Criação:</x-table.td-show>
                        <x-table.td>{{ $categoria->created_at }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Data de Atualização:</x-table.td-show>
                        <x-table.td>{{ $categoria->updated_at }}</x-table.td>
                    </x-table.tr>
                </x-table.tbody>
            </x-div.table-show>
            @slot('rodape')
                @if ($categoria->user_id_create == auth()->user()->id)
                    <x-div.button>
                        <x-button.a href="{{ route('editCategoria', $categoria->id) }}" icon='editar'>Editar</x-button.a>
                        <x-div.form action="{{ route('deleteCategoria', $categoria->id) }}" id="formButtons" method="POST">
                            @slot('metodo')
                                DELETE
                            @endslot
                            @slot('botao')
                                <x-button.button type="submit" icon='deletar'>Deletar</x-button.button>
                            @endslot
                        </x-div.form>
                    </x-div.button>
                @endif
            @endslot
        </x-div.show>
    </x-div.principal>
</x-div.main>
