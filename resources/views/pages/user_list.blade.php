@extends('layouts.app')

@section('head')
    @parent
    <link rel="stylesheet" href="/css/bootstrap-table.min.css" />
    <script src="/js/bootstrap-table.min.js"></script>
    <script src="/js/bootstrap-table-editable.js"></script>
    <script src="/js/bootstrap-table-zh-CN.min.js"></script>
@endsection

@section('content')
<div class="container" style="background-color:white">
    <div id="toolbar" style="margin-top:20px">
        <button type="button" id="modify" data-toggle="modal" data-target="#modal-modify" class="btn btn-primary">修改权限</button>
        <div class="modal fade" id="modal-modify">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">修改权限</h3>
                    </div>

                    <form class="form-horizontal" method="POST" action="{{url('/user/modify')}}">
                        <div class="modal-body">
                            <fieldset>
                                <div>
                                    <label style="margin-left:30px">用户编号<input type="text" class="input-xlarge" style="margin-left:20px" name="id" required="required"></label>
                                </div>
                                <hr />
                                <div>
                                    <label style="margin-left:30px">用户权限<input type="text" class="input-xlarge" style="margin-left:20px" name="privilege" required="required">(0-普通用户 1-管理员)</label>
                                </div>
                            </fieldset>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <input type="submit" class="btn btn-primary" value="修改"></button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <button type="button" id="delete" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger">删除用户</button>
        <div class="modal fade" id="modal-delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">删除用户</h3>
                    </div>

                    <form class="form-horizontal" method="POST" action="{{url('/user/delete')}}">
                        <div class="modal-body">
                            <fieldset>
                                <div>
                                    <label style="margin-left:30px">用户编号<input type="text" class="input-xlarge" style="margin-left:20px" name="id" required="required"></label>
                                </div>
                            </fieldset>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <input type="submit" class="btn btn-danger" value="删除"></button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div><!-- /.toolbar -->
    <table class="table" id="table"  data-toggle="table"></table>
</div>
@endsection

@section('end')
<script type="text/javascript">
    var $table = $('#table');
    function initTable(){
        $('#table').bootstrapTable({
        columns: [{
            field: 'id',
            title: '用户编号',
            align: 'center',
            width: '20%'
        }, {
            field: 'name',
            title: '用户名',
            align:'center',
            width: '30%'
        }, {
            field: 'email',
            title: '邮箱',
            align:'center',
            width: '30%'
        }, {
            field: 'privilege',
            title: '权限',
            align:'center',
            width: '20%'
        }],
        data: [
            @foreach($users as $user)
            {
                id: '{{$user->id}}',
                name: '{{$user->name}}',
                email:'{{$user->email}}',
                privilege: '{{$user->privilege}}'
            },
            @endforeach
        ],
        search:true,
        height:800,
        pagination:true,
    });
    }
    initTable();
</script>
@endsection