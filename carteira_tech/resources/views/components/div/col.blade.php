<div {{ $attributes->merge(['class' => 'col'.  ( @$type ? $type : '' ) ]) }} >
    {{$slot}}
</div>
