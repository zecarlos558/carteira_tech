<x-div.main >
    @section('title','Detalhe Grupo')
    @slot('tituloCentral')
    DETALHE DO GRUPO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Informações do Grupo
        @endslot
        <x-div.show>
            <x-div.table-show>
                <x-table.tbody>
                    <x-table.tr>
                        <x-table.td-show>Nome:</x-table.td-show>
                        <x-table.td>{{ $grupo->nome }}</x-table.td>
                    </x-table.tr>
                </x-table.tbody>
            </x-div.table-show>
            @slot('rodape')
            @if ($grupo->user_id_create == auth()->user()->id)
            <x-div.button>
                <x-button.a href="{{ route('editGrupo', $grupo->id)}}" icon='editar'>Editar</x-button.a>
                <x-div.form action="{{ route('deleteGrupo', $grupo->id) }}" id="formButtons" method="POST" >
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

