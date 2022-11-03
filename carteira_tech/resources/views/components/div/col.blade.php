<div {{ $attributes->merge(['class' => 'col-sm'.  ( $type ? $type : '' ) ]) }} >
    {{$slot}}
</div>
