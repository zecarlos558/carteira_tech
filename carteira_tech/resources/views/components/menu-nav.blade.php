<div>
    <nav class="navbar navbar-expand-xl py-0 bg-light navbar-light">
        <div class="container-fluid" id="navbvarMenu">
            <!-- Logo -->
            <a href="{{ route('indexAplication') }}" class="">
                @component('componentes.logo')
                    130
                @endcomponent
            </a>
            <!-- Botão de Expansão -->
            <button class="navbar-toggler" id="navbarTogller" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenuPrincipal" aria-controls="offcanvasMenuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Início do Canvas -->
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasMenuPrincipal" aria-labelledby="offcanvasMenuPrincipalLabel">
                <div class="offcanvas-header">
                    <h2 class="offcanvas-title" id="offcanvasMenuPrincipalLabel">Isa Store</h2>
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
                        @if ((auth()->user()->can('read entrada')) || (auth()->user()->can('read venda')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='movimentacao'></x-ionicons.ionic>Movimentações</a>
                                <ul class="dropdown-menu">
                                    @can('read venda')
                                    <li><a class="dropdown-item" id="createVenda" href="{{ route('indexVenda') }}">Saídas/Vendas</a></li>
                                    @endcan
                                    @can('read entrada')
                                    <li><a class="dropdown-item" id="createEntrada" href="{{ route('indexEntrada') }}">Entradas/Compras</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if ((auth()->user()->can('read caixa')) || (auth()->user()->can('create caixa')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='caixa'></x-ionicons.ionic>Caixa</a>
                                <ul class="dropdown-menu">
                                    @can('read caixa')
                                    <li><a class="dropdown-item" href="{{ route('indexCaixa') }}">Lista Caixas</a></li>
                                    @endcan
                                    @can(['create caixa'])
                                    <li><a class="dropdown-item" href="{{ route('createCaixa') }}">Cadastrar Caixas</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @can(['read relatorio'])
                        <li class="nav-item">
                            <a class="nav-link" id="indexRelatorio" href="{{ route('indexRelatorio') }}"><x-ionicons.ionic icon='graficos'></x-ionicons.ionic>Relatórios</a>
                        </li>
                        @endcan
                        @if ((auth()->user()->can('read cliente')) || (auth()->user()->can('create cliente')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='cliente'></x-ionicons.ionic>Clientes</a>
                            <ul class="dropdown-menu">
                                @can('read cliente')
                                <li><a class="dropdown-item" href="{{ route('indexCliente') }}">Lista Clientes</a></li>
                                @endcan
                                @can(['create cliente'])
                                <li><a class="dropdown-item" href="{{ route('createCliente') }}">Cadastrar Clientes</a></li>
                                @endcan
                            </ul>
                            </li>
                        @endif
                        @if ((auth()->user()->can('read produto')) || (auth()->user()->can('create produto')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='produto'></x-ionicons.ionic>Produtos</a>
                                <ul class="dropdown-menu">
                                    @can('read produto')
                                    <li><a class="dropdown-item" href="{{ route('indexProduto') }}">Lista Produtos</a></li>
                                    @endcan
                                    @can(['create produto'])
                                    <li><a class="dropdown-item" href="{{ route('createProduto') }}">Cadastrar Produtos</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if ((auth()->user()->can('read fornecedor')) || (auth()->user()->can('create fornecedor')))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='fornecedor'></x-ionicons.ionic>Fornecedores</a>
                                <ul class="dropdown-menu">
                                    @can('read fornecedor')
                                    <li><a class="dropdown-item" href="{{ route('indexFornecedor') }}">Lista Fornecedores</a></li>
                                    @endcan
                                    @can(['create fornecedor'])
                                    <li><a class="dropdown-item" href="{{ route('createFornecedor') }}">Cadastrar Fornecedores</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if ((auth()->user()->can('read plano')) || (auth()->user()->can('create plano')))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><x-ionicons.ionic icon='plano'></x-ionicons.ionic>Planos</a>
                            <ul class="dropdown-menu">
                                @can('read plano')
                                <li><a class="dropdown-item" href="{{ route('indexPlanoPagamento') }}">Lista Planos</a></li>
                                @endcan
                                @can(['create plano'])
                                <li><a class="dropdown-item" href="{{ route('createPlanoPagamento') }}">Cadastrar Planos</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="darkMode()"><ion-icon name="contrast-outline"></ion-icon></a>
                        </li>
                        @component('componentes.cardSession') d-xl-none @endcomponent
                    </ul>
                </div>
            </div>
            @component('componentes.cardSession')
                d-none d-xl-block
            @endcomponent
        </div>
    </nav>
</div>
