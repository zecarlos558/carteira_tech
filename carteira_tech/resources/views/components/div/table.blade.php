<div {{ $attributes->merge(['class' => 'table-reponsive']) }} id="{{ $id ? $id : 'tabelaItens_overflow'  }}" >
    <x-table.table id="{{ $idTabela ? $idTabela : 'tabela'  }}">
        {{$slot}}
    </x-table.table>
</div>
