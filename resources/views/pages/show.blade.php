@extends('app')
@section('content')
    <collection class="format-image group">
        <h2 class="post-title pad">
            <a href="/collections/{{ $collection->id }}" rel="bookmark"> {{ $collection->name }}</a>
        </h2>
        <div class="post-inner">
            <div class="post-content pad">
                <div class="entry custome">
                    {{ $collection->intro }}
                </div>
            </div>
        </div>
    </collection>
@endsection
