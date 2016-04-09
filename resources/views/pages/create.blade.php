@extends('layouts.app')
@section('content')
    <h1>新增藏品</h1>
{!! Form::open(['url'=>'collection/store','files'=>true]) !!}
   <div class="form-group">
       {!! Form::label('name','名称:') !!}
       {!! Form::text('name',null,['class'=>'form-control']) !!}
   </div>
   <div class="form-group">
       {!! Form::label('location','位置:') !!}
       {!! Form::text('location',null,['class'=>'form-control']) !!}
   </div>
   <div class="form-group">
       {!! Form::label('intro','简介:') !!}
       {!! Form::textarea('intro',null,['class'=>'form-control']) !!}
   </div>
   <div class="form-group">
       {!! Form::label('time_rec','建议游览时间:') !!}
       {!! Form::number('time_rec',null,['class'=>'form-control','min'=>1]) !!}
   </div>
   <div class="form-group">
       {!! Form::label('img','图片上传:') !!}
       {!! Form::file('img',null,['class'=>'form-control']) !!}
   </div>
   <div class="form-group">
       {!! Form::submit('保存',['class'=>'btn btn-primary form-control']) !!}
   </div>
{!! Form::close() !!}
    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
