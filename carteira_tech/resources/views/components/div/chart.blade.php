<x-div.main>
@section('head')
    <!-- Scripts Graficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection

@slot('tituloCentral')
    {{@$tituloCentral}}
@endslot

<div {{ $attributes->merge(['class' => '']) }} id="{{ @$id ? $id : '' }}" >
    {{$slot}}
</div>

</x-div.main>
