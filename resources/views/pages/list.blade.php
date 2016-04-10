@extends('layouts.app')
@section('content')
<div class='container' style="background-color:white">
<script>
$(document).ready(function(){
  $("like").click(function(){
        geturl='collection/'+this.getAttribute('meth')+'/'+this.getAttribute('cid');
        $.get(geturl,function(data,status){
        });
        ccid=$(this).attr('cid');
        $('[cid='+ccid+']').toggle();
  });
});
</script>

@section('input')
@show

<h1>{{$title}}</h1>
<div class="row row-offcanvas row-offcanvas-right" style="margin:0">
<div class="col-xs-12 col-sm-9" style="border:1px solid #ddd;border-radius:5px;">
{!! Form::open(['url'=>'collection/delete']) !!}
@foreach($collections as $collection)
         @if (Auth::user()['privilege'])
        <input type="checkbox" name="{{$collection->id}}" />
         @endif
        
<collection class="container">
<div class="media">
  <div class="media-left">
    <a href="/collections/{{ $collection->id }}">
      <img class="media-object" src="/{{ $collection->img_url }}" alt="{{ $collection->name }}" width="200px">
    </a>
  </div>
  <div class="media-body">
    <h2 class="media-heading"><a href="/collections/{{ $collection->id }}"> {{ $collection->name }}</a>
        <div style="float:right" class="h4">
            <like meth="dislike" cid="{{ $collection->id }}"  @if (!Auth::user()->collections()->find($collection->id)) style="display: none" @endif ><span class="glyphicon glyphicon-star" aria-hidden="true"></span>已收藏</like>
            <like meth="like" cid="{{ $collection->id }}"  @if (Auth::user()->collections()->find($collection->id)) style="display: none" @endif ><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>收藏&nbsp&nbsp&nbsp&nbsp</like>
            @if (Auth::user()['privilege'])
            <a href="/collection/edit/{{ $collection->id }}" style="color:black" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>编辑</a>
            @endif
        </div>
    </h2>
    <h6>{{ $collection->type }}</h6>
    <hr />
    <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $collection->intro }}</p>
  </div>
</div>
</collection>
<hr/>
@endforeach
   @if (Auth::user()['privilege'])
   <div class="form-group">
       {!! Form::submit('delete',['class'=>'btn btn-primary']) !!}
   </div>
   @endif
{!! Form::close() !!}
</div>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
<h2>历史纪录</h2>
@foreach(Auth::user()->history as $his)
<div class="thumbnail">
      <a href="/collections/{{ $his->id }}"><img src="/{{ $his->img_url }}" alt="{{ $his->name }}" width="200px"> </a>
      <div class="caption">
        <h3>{{ $his->name }}</h3>
        <p>{{ $his->intro }}</p>
      </div>
    </div>
@endforeach
        <p><a href="/history/clear" class="btn btn-primary" role="button">清除历史纪录</a></p>
</div>
</div>
</div>
@endsection
