<x-div.modal idModal="editarCredito" idTitulo="editarCredito" >
    @slot('titulo')
    Editar valores
    @endslot

    @slot('corpo')
        <x-div.row>
            <x-div.col>
                <x-label.label for="valorTotal">Valor Total do Carrinho</x-label.label>
                <x-input.text  value="{{$slot}}" id="valorTotalEditado" onkeyup="repeteValorOutroCampo()" name="valorTotalEditado" valorTotal="valorTotalPagoModal"></x-input.text>
            </x-div.col>
            <x-div.col>
                <x-label.label for="valorTotalPago">Valor Total Pago</x-label.label>
                <x-input.text  value="{{$slot}}" id="valorTotalPagoModal" onkeyup="repeteValorOutroCampo()" name="valorTotalPagoModal"></x-input.text>
            </x-div.col>
        </x-div.row>
    @endslot

    @slot('rodape')
    <x-button.button type="button"  class="btn-primary">Save</x-button.button>
    @endslot
</x-div.modal>
