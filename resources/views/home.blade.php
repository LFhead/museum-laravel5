@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    {{Auth::user()['name']}}
{{$_SERVER['REQUEST_URI']}}
                    <a href="list"> list</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
