@if ( ($icon == 'criar') || ($icon == 'salvar') )
<button  {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn-primary']) }}><x-ionicons.ionic icon="{{$icon}}"></x-ionicons.ionic>{{$slot}}</button>
@elseif ($icon == 'editar')
<button  {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn-info']) }}><x-ionicons.ionic icon="{{$icon}}"></x-ionicons.ionic>{{$slot}}</button>
@elseif ($icon == 'deletar')
<button  {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn-danger']) }}><x-ionicons.ionic icon="{{$icon}}"></x-ionicons.ionic>{{$slot}}</button>
@elseif ($icon == 'filtrar')
<button  {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn-secondary']) }}><x-ionicons.ionic icon="{{$icon}}"></x-ionicons.ionic>{{$slot}}</button>
@elseif ($icon == 'pesquisar')
<button  {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn-success']) }}><x-ionicons.ionic icon="{{$icon}}"></x-ionicons.ionic>{{$slot}}</button>
@else
<button  {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => '']) }}><x-ionicons.ionic icon="{{$icon}}"></x-ionicons.ionic>{{$slot}}</button>
@endif
