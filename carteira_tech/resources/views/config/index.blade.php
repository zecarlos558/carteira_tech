@extends('layouts.layout')

@section('title', 'Configurações')

@section('content')
    <x-titulo_central> Painel de Configurações </x-titulo_central>
    <div class="container" id="isa-container">
        <!-- Page Content-->
        <x-div.row>
            <x-div.col>
                <div class="container-fluid px-lg-5">
                    <h2 class="pb-2 border-bottom">Nivel de Acesso</h2>
                    <!-- Page Features-->
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <a class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"
                                href="{{ route('indexRole') }}">
                                <ion-icon name="list-sharp"></ion-icon>
                            </a>
                            <h2 class="fs-4 fw-bold">Funções</h2>
                            <p class="mb-0">Página para exibir Funções</p>
                        </div>
                    </div>
                </div>
            </x-div.col>
            <x-div.col>

            </x-div.col>
        </x-div.row>
    </div>
@endsection
