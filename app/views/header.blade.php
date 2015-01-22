@section('header')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('/') }}">Test</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ $page_key == 'home' ? 'active' : '' }}"><a href="{{ URL::to('/') }}">Home</a></li>
                <li class="{{ $page_key == 'profile' ? 'active' : '' }}"><a href="{{ URL::to('user') }}">Profile</a></li>
                <li class="{{ $page_key == 'units' ? 'active' : '' }}"><a href="{{ URL::to('unit') }}">Map Units</a></li>
                <li><a href="{{ URL::to('user/logout') }}">Sign Out</a></li>
            </ul>
        </div>
    </div>
</nav>
@endsection