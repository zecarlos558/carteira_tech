<x-div.main>
    @section('title','Editar User')
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
            <x-label.label for="funcao" >Selecione o nível de Função:</x-label.label>
            <x-input.select id="funcao" name="funcao" >
                <x-input.option value="">Selecione o nível de permissão do Usuário</x-input.option>
                @foreach ($funcoes as $funcao)
                    @if ($funcao->name == $usuario->funcao)
                        <x-input.option selected value="{{$funcao->name}}" >{{$funcao->name}}</x-input.option>
                    @else
                        <x-input.option value="{{$funcao->name}}" >{{$funcao->name}}</x-input.option>
                    @endif
                @endforeach
            </x-input.select>

            @slot('rodape')
                <x-button.button type="submit" class="btn-primary" icon='salvar' >Editar Usuário</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
