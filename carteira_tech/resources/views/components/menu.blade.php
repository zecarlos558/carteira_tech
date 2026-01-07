<div>
    <nav class="navbar navbar-expand-xl py-0 bg-light navbar-light" id="navbvarMenu">
        <div class="container-fluid" >
            <!-- Logo -->
            <a href="{{ route('inicial') }}" class="">
                <x-logo>60</x-logo>
            </a>
            <!-- Botão de Expansão -->
            <button class="navbar-toggler" id="navbarTogller" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenuPrincipal" aria-controls="offcanvasMenuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Início do Canvas -->
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasMenuPrincipal" aria-labelledby="offcanvasMenuPrincipalLabel">
                <div class="offcanvas-header">
                    <h2 class="offcanvas-title" id="offcanvasMenuPrincipalLabel">Carteira Tech</h2>
                    <button type="button" class="btn-close text-reset" id="botaoCloseMenuCanvas" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="d-lg-none">
                        <h5>Menu</h5>
                        <input type="text" id="pesquisaMenu" onkeyup="FuncaoPesquisaMenu()" placeholder="Pesquisa menu..">
                    </div>
                    <ul class="navbar-nav nav-left" id="MenuOpcao">
                        {{--
                        <li class="nav-item">
                            <a href="{{ route('indexAplication') }}" id="inicial" class="nav-link"><x-ionicons.ionic icon='home'></x-ionicons.ionic>Inicial</a>
                        </li>
                        --}}
                        @if ((auth()->user()->can('read movimento')) || (auth()->user()->can('create movimento')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='dolar'></x-ionicons.ionic>Transações</a>
                                <ul class="dropdown-menu">
                                    @can('read movimento')
                                    <li><a class="dropdown-item" id="indexMovimento" href="{{ route('indexMovimento') }}">Listar Transações</a></li>
                                    @endcan
                                    @can('read movimento')
                                    <li><a class="dropdown-item" id="indexMovimentoRenda" href="{{ route('indexMovimentoRenda') }}">Transação Renda</a></li>
                                    @endcan
                                    @can('read movimento')
                                    <li><a class="dropdown-item" id="indexMovimentoGasto" href="{{ route('indexMovimentoGasto') }}">Transação Retirada</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if ((auth()->user()->can('read categoria')) || (auth()->user()->can('create categoria')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='categoria'></x-ionicons.ionic>Categorias</a>
                                <ul class="dropdown-menu">
                                    @can('read categoria')
                                    <li><a class="dropdown-item" id="indexCategoria" href="{{ route('indexCategoria') }}">Listar Categoria</a></li>
                                    @endcan
                                    @can('create categoria')
                                    <li><a class="dropdown-item" id="createCategoria" href="{{ route('createCategoria') }}">Cadastrar Categoria</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if ((auth()->user()->can('read grupo')) || (auth()->user()->can('create grupo')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='grupo'></x-ionicons.ionic>Grupos</a>
                                <ul class="dropdown-menu">
                                    @can('read grupo')
                                    <li><a class="dropdown-item" id="indexGrupo" href="{{ route('indexGrupo') }}">Listar Grupo</a></li>
                                    @endcan
                                    @can('create grupo')
                                    <li><a class="dropdown-item" id="createGrupo" href="{{ route('createGrupo') }}">Cadastrar Grupo</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if ((auth()->user()->can('read tipo')) || (auth()->user()->can('create tipo')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='tipo'></x-ionicons.ionic>Tipos</a>
                                <ul class="dropdown-menu">
                                    @can('read tipo')
                                    <li><a class="dropdown-item" id="indexTipo" href="{{ route('indexTipo') }}">Listar Tipo</a></li>
                                    @endcan
                                    @can('create tipo')
                                    <li><a class="dropdown-item" id="createTipo" href="{{ route('createTipo') }}">Cadastrar Tipo</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if ((auth()->user()->can('read conta')) || (auth()->user()->can('create conta')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='conta'></x-ionicons.ionic>Contas</a>
                                <ul class="dropdown-menu">
                                    @can('read conta')
                                    <li><a class="dropdown-item" id="indexConta" href="{{ route('indexConta') }}">Listar Conta</a></li>
                                    @endcan
                                    @can('create conta')
                                    <li><a class="dropdown-item" id="createConta" href="{{ route('createConta') }}">Cadastrar Conta</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if ((auth()->user()->can('read relatorio')) || (auth()->user()->can('create relatorio')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='relatorio'></x-ionicons.ionic>Relatórios</a>
                                <ul class="dropdown-menu">
                                    @can('read relatorio')
                                    <li><a class="dropdown-item" id="indexRelatorio" href="{{ route('indexRelatorio') }}">Painel Financeiro</a></li>
                                    @endcan
                                    @can('create relatorio')
                                    <li><a class="dropdown-item" id="createRelatorio" href="{{ route('createRelatorio') }}">Financeiro Personalizado (.PDF)</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        <x-card_session class="d-xl-none"></x-card_session>
                    </ul>
                </div>
            </div>
            <x-card_session class="d-none d-xl-block"></x-card_session>
        </div>
    </nav>
</div>
