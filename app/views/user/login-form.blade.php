@extends('layouts.master')

@section('content')
<div id="login-content">
    <div id="login-form-wrap">
        <form class="login-form" method="post">
            <label>
                Username<br />
                <input type="text" name="username" required value="{{ Input::old('username') }}" />
            </label>
            <label>
                Password<br />
                <input type="password" name="password" required />
            </label>
            <input type="submit" value="Sign In" />
        </form>
    </div>
</div>
@endsection