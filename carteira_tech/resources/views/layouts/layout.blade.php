<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <script src="/js/bootstrap.bundle.min.js" defer></script>
    <script src="/js/scripts.js" defer></script>

    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css" defer>

    @yield('head')

</head>
<body>
    <header>
        <x-menu></x-menu>
    </header>

    @yield('content')

    <footer>
        <p ><ion-icon name="logo-laravel"></ion-icon> SAMOTECH &copy; {{date('d/m/Y')}}</p>
    </footer>
        <!-- Script do Framework Ionicons -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
