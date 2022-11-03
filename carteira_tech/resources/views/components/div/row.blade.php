<div  {{ $attributes->merge(['class' => 'row'. ( $type ? $type : '' ) ]) }} >
    {{$slot}}
</div>
