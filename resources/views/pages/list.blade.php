@extends('layouts.app')
@section('content')
<div class='container'>
<script>
$(document).ready(function(){
  $("like").click(function(){
        geturl='collection/'+this.getAttribute('meth')+'/'+this.getAttribute('cid');
        $.get(geturl,function(data,status){
            alert("数据：" + data + "\n状态：" + status);
        });
        ccid=$(this).attr('cid');
        $('[cid='+ccid+']').toggle();
  });
});
</script>
{!! Form::open(['url'=>'collection/delete']) !!}
@foreach($collections as $collection)
<collection class="format-image group">
    <h2 class="post-title pad">
         @if (Auth::user()['privilege'])
        <input type="checkbox" name="{{$collection->id}}" />
         @endif
        <a href="/collections/{{ $collection->id }}"> {{ $collection->name}}</a>
    </h2>
    <div class="post-inner">
        <div class="post-deco">
            <div class="hex hex-small">
                <div class="hex-inner"><i class="fa"></i></div>
                <div class="corner-1"></div>
                <div class="corner-2"></div>
            </div>
        </div>
        <div class="post-content pad">
            <div class="entry custome">
                {{ $collection->intro }}
            </div>
            <a class="more-link-custom" href="/collections/{{ $collection->id }}"><span><i>更多</i></span></a>
            <like meth="dislike" cid="{{ $collection->id }}" class="more-link-custom" @if (!Auth::user()->collections()->find($collection->id)) style="display: none" @endif ><span><i>dislike</i></span></like>
            <like meth="like" cid="{{ $collection->id }}" class="more-link-custom" @if (Auth::user()->collections()->find($collection->id)) style="display: none" @endif ><span><i>like</i></span></like>
            @if (Auth::user()['privilege'])
            <a class="more-link-custom" href="/collection/edit/{{ $collection->id }}"><span><i>编辑</i></span></a>
            @endif
        </div>
    </div>
</collection>
@endforeach
   @if (Auth::user()['privilege'])
   <div class="form-group">
       {!! Form::submit('delete',['class'=>'btn btn-success form-control']) !!}
   </div>
   @endif
{!! Form::close() !!}
</div>
@foreach($collections as $collection)
@if (Auth::user()->history()->find($collection->id))
    {{$collection->name}}
@endif
@endforeach
@endsection
