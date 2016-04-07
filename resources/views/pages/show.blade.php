@extends('app')
@section('content')
    <collection class="format-image group">
        <h2 class="post-title pad" align="center">
            <a href="/collections/{{ $collection->id }}" rel="bookmark"> {{ $collection->name }}</a>
        </h2>
        <h5 class="post-title pad">藏品简介</h5>
        <div class="post-inner">
            <div class="post-deco">
            </div>
            <div class="post-content pad">
                <div class="entry custome">
                    {{ $collection->intro }}
                </div>
            </div>
        </div>

        <div class="post-inner">
            <div class="post-deco">
            </div>
            <div class="post-content pad">
                <div class="entry custome">藏品位置：{{ $collection->location }}</div>
                <div class="entry custome">推荐浏览时间：{{ $collection->time_rec }}分钟</div>
            </div>
        </div>

        <h5 class="post-title pad">图片展示</h5>
        
        <div  align="center">
            <img src="{{ $collection->img_url }}" alt="{{ $collection->name }}"/>
        </div>
    </collection>

    <div style="margin-top:50px">
        <a class="btn btn-success form-control" href="/list">返回藏品列表</a>
    </div>
@endsection
