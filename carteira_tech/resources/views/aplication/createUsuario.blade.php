<x-div.main>
    @section('title','Cadastro User')
    @slot('tituloCentral')
    CADASTRO USUÁRIO
    @endslot
    <x-div.principal>
        @slot('titulo')
            Preencha os dados do Usuário
        @endslot
        <x-div.form action="{{ route('storeUsuario') }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ old('nome') }}" name="nome" id="nome" placeholder="Nome do Usuário" />

            <x-label.label for="email">Email:</x-label.label>
            <x-input.email value="{{ old('email') }}" name="email" id="email"></x-input.email>

            <x-label.label for="funcao" >Nível de Função:</x-label.label>
            <x-input.select id="funcao" name="funcao" >
                <x-input.option value="">Selecione o nível de Função do Usuário</x-input.option>
                @foreach ($funcoes as $funcao)
                <x-input.option value="{{$funcao->name}}" >{{$funcao->name}}</x-input.option>
                @endforeach
            </x-input.select>

            <x-label.label for="password">Senha:</x-label.label>
            <div class="input-group">
                <x-input.password value="" name="password" id="password" placeholder="Senha do Usuário"></x-input.password>
                <x-label.span icon="olho" id="olho" class="input-group-text" data-bs-toggle="tooltip" onclick="exibeSenha()" title="Mostra Senha!"></x-label.span>
            </div>

            <x-label.label for="password_confirmation">Confirme a Senha:</x-label.label>
            <div class="input-group">
                <x-input.password value="" name="password_confirmation" id="password_confirmation" placeholder="Repita a senha do Usuário"></x-input.password>
                <x-label.span icon="olho" id="olho2" class="input-group-text" data-bs-toggle="tooltip" onclick="exibeSenha2()" title="Mostra Senha!"></x-label.span>
            </div>
            @slot('rodape')
                <x-button.button type="submit" icon='salvar' >Cadastrar Usuário</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
