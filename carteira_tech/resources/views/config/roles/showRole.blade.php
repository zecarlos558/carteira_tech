<x-div.main >
    @section('title','Detalhe Função')
    @slot('tituloCentral')
        Detalhe Função
    @endslot
    <x-div.principal>
        @slot('titulo')
            Informações da Função
        @endslot
        <x-div.show>
            <x-div.table-show>
                <x-table.tbody>
                    <x-table.tr>
                        <x-table.td-show>ID:</x-table.td-show>
                        <x-table.td>{{ $role->id }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Nome:</x-table.td-show>
                        <x-table.td>{{ $role->name }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Guard Name:</x-table.td-show>
                        <x-table.td>{{ $role->guard_name }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.td-show>Usuarios ativos:</x-table.td-show>
                        <x-table.td>{{ count($usuarios) }}</x-table.td>
                    </x-table.tr>
                </x-table.tbody>
            </x-div.table-show>
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
                            <x-input.checkbox id="read {{$funcao}}" name="read {{$funcao}}" value="read {{$funcao}}" disabled>
                            </x-input.checkbox>
                            <x-label.label class="form-check-label" for="read {{$funcao}}">Listar {{ucfirst($funcao)}}:</x-label.label>
                        </x-div.input>
                        <x-div.input class="form-check">
                            <x-input.checkbox id="create {{$funcao}}" name="create {{$funcao}}" value="create {{$funcao}}" disabled>
                            </x-input.checkbox>
                            <x-label.label class="form-check-label" for="create {{$funcao}}">Cadastrar {{ucfirst($funcao)}}:</x-label.label>
                        </x-div.input>
                        <x-div.input class="form-check">
                            <x-input.checkbox id="edit {{$funcao}}" name="edit {{$funcao}}" value="edit {{$funcao}}" disabled>
                            </x-input.checkbox>
                            <x-label.label class="form-check-label" for="edit {{$funcao}}">Editar {{ucfirst($funcao)}}:</x-label.label>
                        </x-div.input>
                        <x-div.input class="form-check">
                            <x-input.checkbox id="delete {{$funcao}}" name="delete {{$funcao}}" value="delete {{$funcao}}" disabled>
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
                                <x-input.checkbox id="read {{$funcao}}" name="read {{$funcao}}" value="read {{$funcao}}" disabled>
                                </x-input.checkbox>
                                <x-label.label class="form-check-label" for="read {{$funcao}}">Listar {{ucfirst($funcao)}}:</x-label.label>
                            </x-div.input>
                            <x-div.input class="form-check">
                                <x-input.checkbox id="create {{$funcao}}" name="create {{$funcao}}" value="create {{$funcao}}" disabled>
                                </x-input.checkbox>
                                <x-label.label class="form-check-label" for="create {{$funcao}}">Cadastrar {{ucfirst($funcao)}}:</x-label.label>
                            </x-div.input>
                            <x-div.input class="form-check">
                                <x-input.checkbox id="edit {{$funcao}}" name="edit {{$funcao}}" value="edit {{$funcao}}" disabled>
                                </x-input.checkbox>
                                <x-label.label class="form-check-label" for="edit {{$funcao}}">Editar {{ucfirst($funcao)}}:</x-label.label>
                            </x-div.input>
                            <x-div.input class="form-check">
                                <x-input.checkbox id="delete {{$funcao}}" name="delete {{$funcao}}" value="delete {{$funcao}}" disabled>
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
            <x-div.button>
                <x-button.a href="{{ route('editRole', $role->id)}}" class="btn-info edit-btn" icon='editar'>Editar</x-button.a>
                <x-div.form action="{{ route('deleteRole', $role->id) }}" id="formButtons" method="POST" >
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

            <script>
                window.onload = function() {
                    var funcao = '<?php echo json_encode($role->permissions); ?>';
                    var funcoes = '<?php echo json_encode($funcoes); ?>';
                    verificaRole(funcao,funcoes)
                }
            </script>
    </x-div.principal>
</x-div.main>
