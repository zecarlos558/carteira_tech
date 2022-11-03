@extends('layouts_main.main')

@section('head')
    <!-- Scripts Locais -->
    <script src="/js/multiselect-dropdown.js" ></script>
    <!-- Scripts Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endsection

@section('content')

    @yield('contentMultiselect')

@endsection
