@extends('layouts.app')
@section('content')
    <div class="container" style="background-color:white">
        <h2>
            <a href="/collections/{{ $collection->id }}"> {{ $collection->name }}</a>
        </h2>
        <hr />
        <div class="form-group">
            <div align="center">
                <img src="/{{ $collection->img_url }}" alt="{{ $collection->name }}"/>
            </div>
            <hr />
            <label>藏品简介</label>
            <div>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $collection->intro }}
            </div>
            <hr />
            <div>
                <div><strong>藏品类型：</strong>{{ $collection->type }}</div>
                <hr />
                <div><strong>藏品位置：</strong>{{ $collection->location }}</div>
                <hr />
                <div><strong>推荐浏览时间：</strong>{{ $collection->time_rec }}分钟</div>
            </div>
        </div>
    </div>
@endsection 