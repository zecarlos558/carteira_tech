<li {{ $attributes->merge(['class' => 'nav-item']) }} >

    @if ($type == 'active')
    <a class="nav-link active" data-bs-toggle="pill" href="#{{@$href}}">{{$slot}}</a>
    @else
    <a class="nav-link" data-bs-toggle="pill" href="#{{@$href}}">{{$slot}}</a>
    @endif

</li>
