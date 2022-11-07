<x-div.main>
    @section('title','Cadastro Função')
    @slot('tituloCentral')
        Cadastro Função
    @endslot
    <x-div.principal>
        @slot('titulo')
            Preencha os dados da Função
        @endslot
        <x-div.form action="{{ route('storeRole') }}" method="POST">
            @slot('metodo')
                "POST"
            @endslot
            <x-label.label for="nome">Nome:</x-label.label>
            <x-input.text value="{{ old('nome') }}" name="nome" id="nome" placeholder="Nome da Função" />
            <h4>Permissões da Função</h4>
            @for ($i = 0; $i < count($funcoes); $i++)
            @php
                $funcao = $funcoes[$i]
            @endphp
            <x-div.row>
                <x-div.col>
                    <x-div.input>
                        <x-label.label>{{ucfirst($funcao)}}:</x-label.label>
                        <x-div.input class="form-check">
                            <x-input.checkbox id="read {{$funcao}}" name="read {{$funcao}}" value="read {{$funcao}}" >
                            </x-input.checkbox>
                            <x-label.label class="form-check-label" for="read {{$funcao}}">Listar {{ucfirst($funcao)}}:</x-label.label>
                        </x-div.input>
                        <x-div.input class="form-check">
                            <x-input.checkbox id="create {{$funcao}}" name="create {{$funcao}}" value="create {{$funcao}}" >
                            </x-input.checkbox>
                            <x-label.label class="form-check-label" for="create {{$funcao}}">Cadastrar {{ucfirst($funcao)}}:</x-label.label>
                        </x-div.input>
                        <x-div.input class="form-check">
                            <x-input.checkbox id="edit {{$funcao}}" name="edit {{$funcao}}" value="edit {{$funcao}}" >
                            </x-input.checkbox>
                            <x-label.label class="form-check-label" for="edit {{$funcao}}">Editar {{ucfirst($funcao)}}:</x-label.label>
                        </x-div.input>
                        <x-div.input class="form-check">
                            <x-input.checkbox id="delete {{$funcao}}" name="delete {{$funcao}}" value="delete {{$funcao}}" >
                            </x-input.checkbox>
                            <x-label.label class="form-check-label" for="delete {{$funcao}}">Excluir {{ucfirst($funcao)}}:</x-label.label>
                        </x-div.input>
                    </x-div.input>
                </x-div.col>
                @php
                    $i++
                @endphp
                @if ($i < count($funcoes))
                    @php
                        $funcao = $funcoes[$i]
                    @endphp
                    <x-div.col>
                        <x-div.input>
                            <x-label.label>{{ucfirst($funcao)}}:</x-label.label>
                            <x-div.input class="form-check">
                                <x-input.checkbox id="read {{$funcao}}" name="read {{$funcao}}" value="read {{$funcao}}" >
                                </x-input.checkbox>
                                <x-label.label class="form-check-label" for="read {{$funcao}}">Listar {{ucfirst($funcao)}}:</x-label.label>
                            </x-div.input>
                            <x-div.input class="form-check">
                                <x-input.checkbox id="create {{$funcao}}" name="create {{$funcao}}" value="create {{$funcao}}" >
                                </x-input.checkbox>
                                <x-label.label class="form-check-label" for="create {{$funcao}}">Cadastrar {{ucfirst($funcao)}}:</x-label.label>
                            </x-div.input>
                            <x-div.input class="form-check">
                                <x-input.checkbox id="edit {{$funcao}}" name="edit {{$funcao}}" value="edit {{$funcao}}" >
                                </x-input.checkbox>
                                <x-label.label class="form-check-label" for="edit {{$funcao}}">Editar {{ucfirst($funcao)}}:</x-label.label>
                            </x-div.input>
                            <x-div.input class="form-check">
                                <x-input.checkbox id="delete {{$funcao}}" name="delete {{$funcao}}" value="delete {{$funcao}}" >
                                </x-input.checkbox>
                                <x-label.label class="form-check-label" for="delete {{$funcao}}">Excluir {{ucfirst($funcao)}}:</x-label.label>
                            </x-div.input>
                        </x-div.input>
                    </x-div.col>
                @else
                    <x-div.col></x-div.col>
                @endif
            </x-div.row>
            @endfor
            @slot('rodape')
                <x-button.button type="submit" icon='salvar' >Cadastrar Função</x-button.button>
            @endslot
        </x-div.form>
    </x-div.principal>
</x-div.main>
