@extends('layouts.app')
@section('content')
    <h1>修改藏品</h1>
{!! Form::model($collection,['url'=>'collection/update','files'=>true]) !!}
    {!! Form::hidden('id',$collection->id) !!}
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
       {!! Form::label('type','藏品类型:') !!}
        <select class='form-control' name="type">
            <option value="文物">文物</option>
            <option value="书画">书画</option>
            <option value="玉器">玉器</option>
            <option value="珠宝">珠宝</option>
            <option value="其他">其他</option>
        </select>
   </div>
   <div class="form-group">
       {!! Form::label('img','图片上传:') !!}
       {!! Form::file('img',null,['class'=>'form-control']) !!}
   </div>
   <div class="form-group">
       {!! Form::submit('更新',['class'=>'btn btn-primary form-control']) !!}
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
