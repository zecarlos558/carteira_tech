<x-div.main>
    @section('title', 'Detalhe Tipo')
    @slot('tituloCentral')
        DETALHE DA TIPO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Informações da Tipo
        @endslot
        <x-div.show>
            <x-div.table-show>
                <x-table.tbody>
                    <x-table.tr>
                        <x-table.td-show>ID:</x-table.td-show>
                        <x-table.td>{{ $tipo->id }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Nome:</x-table.td-show>
                        <x-table.td>{{ $tipo->nome }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Data de Criação:</x-table.td-show>
                        <x-table.td>{{ $tipo->created_at }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Data de Atualização:</x-table.td-show>
                        <x-table.td>{{ $tipo->updated_at }}</x-table.td>
                    </x-table.tr>
                </x-table.tbody>
            </x-div.table-show>
            @slot('rodape')
                @if ($tipo->user_id_create == auth()->user()->id)
                    <x-div.button>
                        <x-button.a href="{{ route('editTipo', $tipo->id) }}" icon='editar'>Editar</x-button.a>
                        <x-div.form action="{{ route('deleteTipo', $tipo->id) }}" id="formButtons" method="POST">
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
