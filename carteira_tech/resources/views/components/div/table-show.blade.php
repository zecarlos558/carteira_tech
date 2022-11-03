<div {{ $attributes->merge(['class' => 'table-reponsive']) }} id="{{$id}}" >
    <x-table.table-show>
        {{$slot}}
    </x-table.table-show>
</div>
