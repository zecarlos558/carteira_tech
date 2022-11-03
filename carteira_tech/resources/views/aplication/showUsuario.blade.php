<x-div.main >
    @section('title','Detalhe User')
    @slot('tituloCentral')
    DETALHE DO USUÁRIO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Informações do Usuário
        @endslot
        <x-div.show>
            <x-div.table-show>
                <x-table.tbody>
                    <x-table.tr>
                        <x-table.td-show>ID:</x-table.td-show>
                        <x-table.td>{{ $usuario->id }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Nome:</x-table.td-show>
                        <x-table.td>{{ $usuario->name }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Email:</x-table.td-show>
                        <x-table.td>{{ $usuario->email }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Nível de Acesso:</x-table.td-show>
                        <x-table.td>{{ $usuario->funcao }}</x-table.td>
                    </x-table.tr>
                </x-table.tbody>
            </x-div.table-show>
            @slot('rodape')
            <x-div.button>
                <x-button.a href="{{ route('editUsuario', $usuario->id)}}" class="btn-info edit-btn" icon='editar'>Editar</x-button.a>
                <x-div.form action="{{ route('deleteUsuario', $usuario->id) }}" id="formButtons" method="POST" >
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

