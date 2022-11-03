@extends('layouts_main.main')

@section('head')
    <!-- Scripts Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endsection

@section('content')

    @yield('contentTable')
    @component('componentes.ordenarTabela')@endcomponent
@endsection
