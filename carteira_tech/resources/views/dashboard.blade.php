<x-div.main >
    @section('title','Painel Usuário')
    @slot('tituloCentral')
    Painel
    @endslot
    <x-div.principal>

            @slot('titulo')
                Você está Logado!<br>
                Dados do Usuário
            @endslot
            @slot('rodape')
                <x-div.button class="mt-3">
                    @can('read usuario')
                        <x-button.a href="{{ route('painelControleUsuario') }}" class="btn btn-info" icon="painel" >Painel de Usuários</x-button.a>
                    @endcan
                    @can('read config')
                    <x-button.a href="{{ route('indexConfig') }}" class="btn btn-success" icon="config" >Configurações</x-button.a>
                    @endcan
                    @can('edit usuario')
                    <x-button.a href="{{ route('editUsuario', $user->id) }}" class="btn btn-primary" icon="config" >Editar Dados</x-button.a>
                    @endcan
                </x-div.button>
            @endslot
            <x-div.show>
                <x-div.table-show>
                    <x-table.tbody>
                        <x-table.tr>
                            <x-table.td-show>ID:</x-table.td-show>
                            <x-table.td>{{ $user->id }}</x-table.td>
                        </x-table.tr>
                        <x-table.tr>
                            <x-table.td-show>Nome:</x-table.td-show>
                            <x-table.td>{{ $user->name }}</x-table.td>
                        </x-table.tr>
                        <x-table.tr>
                            <x-table.td-show>Email:</x-table.td-show>
                            <x-table.td>{{ $user->email }}</x-table.td>
                        </x-table.tr>
                        <x-table.tr>
                            <x-table.td-show>Nível de Acesso:</x-table.td-show>
                            <x-table.td>{{ $user->funcao }}</x-table.td>
                        </x-table.tr>
                        <x-table.tr>
                            <x-table.td-show>Email Autenticado:</x-table.td-show>
                            <x-table.td>{{ ($user->email_verified_at) ? 'Verificado' : 'Não verificado' }}</x-table.td>
                        </x-table.tr>
                    </x-table.tbody>
                </x-div.table-show>
            </x-div.show>

    </x-div.principal>
</x-div.main>
