<x-div.main>
    @section('title', 'Editar User')
    @slot('tituloCentral')
        EDITAR USUÁRIO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Edite os dados do Usuário
        @endslot
        <x-div.form action="{{ route('updateUsuario', $usuario->id) }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ $usuario->name }}" name="nome" id="nome" placeholder="Nome do Usuário" />

            <x-label.label for="email">Email:</x-label.label>
            <x-input.email value="{{ $usuario->email }}" name="email" id="email"></x-input.email>

            @can('create usuario')
            <div style="display: block;" >
            @else
            <div style="display: none;" >
            @endcan
                <x-label.label for="funcao">Selecione o nível de Função:</x-label.label>
                <x-input.select id="funcao" name="funcao">
                    <x-input.option value="">Selecione o nível de permissão do Usuário</x-input.option>
                    @foreach ($funcoes as $funcao)
                        @if ($funcao->name == $usuario->getRoleNames()->first())
                            <x-input.option selected value="{{ $funcao->name }}">{{ $funcao->name }}</x-input.option>
                        @else
                            <x-input.option value="{{ $funcao->name }}">{{ $funcao->name }}</x-input.option>
                        @endif
                    @endforeach
                </x-input.select>
            </div>
            @slot('rodape')
                <x-div.button>
                    <x-button.button type="submit" icon='salvar'>Editar Usuário</x-button.button>
                    <x-button.a class="btn-secondary" href="{{ route('autentica_email') }}">Autenticar Email</x-button.a>
                </x-div.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
