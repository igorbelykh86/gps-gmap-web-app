@section('main_content')
    <h1>Edit Unit #{{ $unit->id }}</h1>
    {{ Form::open() }}
        <label>
            Unit Name:
            {{ Form::text('name', $unit->name) }}
        </label>
        {{ Form::token() }}
        {{ Form::submit('Save') }}
    {{ Form::close() }}
@stop