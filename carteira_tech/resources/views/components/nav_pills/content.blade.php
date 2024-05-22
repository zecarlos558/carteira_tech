<div id="{{$id}}" {{ $attributes->merge(['class' => 'tab-pane '.( @$type ? $type : '' ) ]) }}><br>
    {{$slot}}
</div>
