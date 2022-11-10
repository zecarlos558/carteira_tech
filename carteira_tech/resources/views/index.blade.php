<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/logomarca_favicon.ico">
    <title>Carteira Tech</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous" defer>
    </script>
    <script src="/js/scripts.js" defer></script>

    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body id="corpo">

    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <a href="{{ route('index') }}" class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                    <x-logo>40</x-logo>
                </a>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar brand -->
                    <a class="navbar-brand mt-2 mt-lg-0" style="color: blue" href="{{ route('index') }}">
                        Carteira Tech
                    </a>
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"></a>
                        </li>
                    </ul>
                    <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <div class="d-flex align-items-center">

                    <!-- Notifications -->
                    <div class="dropdown">
                        <a class="btn btn-outline-primary" href="{{ route('register') }}"><x-ionicons.ionic icon="usuario"></x-ionicons.ionic>Criar Conta</a>
                    </div>
                    <!-- Avatar -->
                    <div class="dropdown">
                        <a class="btn btn-outline-info" href="{{ route('login') }}"><x-ionicons.ionic icon="login"></x-ionicons.ionic>Login</a>
                    </div>

                </div>
                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>

    <div class="container-fluid">
        <div id="index">
            <div class="row mt-5">
                <div class="col-sm" id="texto" style="background-color: lightskyblue;">
                    <div class="center-block">
                        <h1 style="color: green">Carteira Tech</h1>
                        <h4 style="text-align: center" >Sua Carteira digital</h4>
                        <ul>
                            <li>Adicione Transações</li>
                            <li>Veja seus relatórios</li>
                            <li>Organize sua vida financeira</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm" id="logo">
                    <x-logo>400</x-logo>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>
            <ion-icon name="logo-laravel"></ion-icon> SAMOTECH &copy; {{ date('d/m/Y') }}
        </p>
    </footer>
    <!-- Script do Framework Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
