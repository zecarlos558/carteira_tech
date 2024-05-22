@if ( (@$icon == 'criar') || (@$icon == 'salvar') )
<a {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn-primary']) }} role="button" ><x-ionicons.ionic icon="{{@$icon}}"></x-ionicons.ionic>{{$slot}}</a>
@elseif (@$icon == 'editar')
<a {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn-info']) }} role="button" ><x-ionicons.ionic icon="{{@$icon}}"></x-ionicons.ionic>{{$slot}}</a>
@elseif (@$icon == 'deletar')
<a {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn-danger']) }} role="button" ><x-ionicons.ionic icon="{{@$icon}}"></x-ionicons.ionic>{{$slot}}</a>
@elseif (@$icon == 'filtrar')
<a {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn-secondary']) }} role="button" ><x-ionicons.ionic icon="{{@$icon}}"></x-ionicons.ionic>{{$slot}}</a>
@elseif (@$icon == 'pesquisar')
<a {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn-success']) }} role="button" ><x-ionicons.ionic icon="{{@$icon}}"></x-ionicons.ionic>{{$slot}}</a>
@else
<a {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => '']) }} role="button" ><x-ionicons.ionic icon="{{@$icon}}"></x-ionicons.ionic>{{$slot}}</a>
@endif
