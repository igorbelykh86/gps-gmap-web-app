@section('main_content')
    <h1>Map</h1>
    <div class="row">
        <div class="col-md-12" id="map-wrap">
            <div id="map"></div>
            <script>
                window.map_units = {{ json_encode($map_units) }};
                window.use_comet = window.google_maps = true;
            </script>
        </div>
    </div>
@endsection