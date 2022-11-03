<x-div.main>
    @section('title','Editar Conta')
    @slot('tituloCentral')
    EDITAR CONTA
    @endslot
    <x-div.principal>
        @slot('titulo')
            Edite os dados do Conta
        @endslot
        <x-div.form action="{{ route('updateConta', $conta->id) }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ $conta->nome }}" name="nome" id="nome" placeholder="Nome do Conta" />

            <x-label.label class="form-label" for="valor">Valor da Conta:</x-label.label>
            <x-input.number value="{{$conta->valor}}" name="valor" id="valor" placeholder="Valor da Conta" />

            <x-label.label for="funcao" >Tipo da Conta:</x-label.label>
            <x-input.select id="funcao" name="funcao" >
                @foreach ($tipos as $tipo)
                    @if ($tipo->nome == $conta->funcao)
                        <x-input.option selected value="{{$tipo->id}}" >{{$tipo->nome}}</x-input.option>
                    @else
                        <x-input.option value="{{$tipo->id}}" >{{$tipo->nome}}</x-input.option>
                    @endif
                @endforeach
            </x-input.select>

            @slot('rodape')
                <x-button.button type="submit" class="btn-primary" icon='salvar' >Editar Conta</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
