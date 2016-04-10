@extends('pages.list')

@section('input')
<div style="margin-top:20px">
{!! Form::open(['url'=>'recommend/time']) !!}
   	{!! Form::label('name','浏览时间:') !!}
   	{!! Form::text('time',null,['required'=>'required']) !!}
{!! Form::submit('确定',['class'=>'btn btn-primary','style'=>'margin-left:10px']) !!}
</div>
@stop