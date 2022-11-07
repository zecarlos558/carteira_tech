<x-div.main>
    @section('title','Relatório')
    @slot('tituloCentral')
    Relatório Financeiro
    @endslot
    <x-div.principal>
        @slot('titulo')
            Resumo Relatório
        @endslot

        <x-div.row type="justify-content-around mt-2">
            <div class="col">
                <x-button.a class="btn-outline-info" href="{{ route('showRelatorioRenda')}}">
                    <x-div.card class="bg-success" style="color: white" >
                        @slot('header')
                            Renda
                        @endslot
                        @slot('corpo')
                        <h1><x-label.span-default icon="pagamento" style="text-align: center" >{{ $relatorio->valorTotalEntrada }}</x-label.span></h1>
                        @endslot
                    </x-div.card>
                </x-button.a>
            </div>
            <div class="col">
                <x-button.a class="btn-outline-info" href="{{ route('showRelatorioGasto') }}">
                    <x-div.card class="bg-danger" style="color: white" >
                        @slot('header')
                            Gastos
                        @endslot
                        @slot('corpo')
                        <h1><x-label.span-default icon="pagamento" style="text-align: center" >{{ $relatorio->valorTotalSaida }}</x-label.span></h1>
                        @endslot
                    </x-div.card>
                </x-button.a>
            </div>
        </x-div.row>
        <hr>
        <x-div.input class="border" id="isa-container" >
            @foreach ($relatorioCategorias as $relatorios)
                <h4>{{ $relatorios->nome }}</h4>
                <h5>{{ $relatorios->valorTotal }}</h5>
                <div class="progress pd-3 mb-3">
                    <div class="progress-bar bg-primary" role="progressbar"
                        style="width: {{ $relatorios->barraProgresso }}%"
                        aria-valuenow="{{ $relatorios->barraProgresso }}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            @endforeach
        </x-div.input>
    </x-div.principal>
</x-div.main>
