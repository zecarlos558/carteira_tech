@if (session()->get('device'))
    <ion-icon {{ $attributes->merge(['name' => '']) }}>{{$slot}}</ion-icon>
@else
    <ion-icon {{ $attributes->merge(['name' => '']) }}>{{$slot}}</ion-icon>
@endif
