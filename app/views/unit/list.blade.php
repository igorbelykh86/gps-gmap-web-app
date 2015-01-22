@section('main_content')
    <h1>Map Units</h1>
    @foreach($units as $unit)
    <div class="row unit-list-item">
        <div class="col-md-2">#{{ $unit->id }}</div>
        <div class="col-md-8">{{ $unit->name }}</div>
        <div class="col-md-1">
            <a href="{{ URL::to('unit/edit/' . $unit->id) }}">edit</a>
        </div>
    </div>
    @endforeach
    <div class="row"><hr /></div>
    <div class="row">
        <div class="text-center">{{ $units->links() }}</div>
    </div>
@endsection