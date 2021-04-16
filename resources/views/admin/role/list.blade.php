@extends('web.layout.layout')
@section('content')
    <div class="x-nav">
          <span class="layui-breadcrumb">
            <a >首页</a>
            <a >管理员管理</a>
            <a>
              <cite>角色管理</cite></a>
          </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
           onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    {{--<div class="layui-card-body ">
                        <form class="layui-form layui-col-space5">
                            <div class="layui-inline layui-show-xs-block">
                                <input class="layui-input" autocomplete="off" placeholder="开始日" name="start" id="start">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input class="layui-input" autocomplete="off" placeholder="截止日" name="end" id="end">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="username" placeholder="请输入用户名" autocomplete="off"
                                       class="layui-input">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i>
                                </button>
                            </div>
                        </form>
                    </div>--}}
                    <div class="layui-card-header">
                        <button class="layui-btn" onclick="xadmin.open('添加角色','{{asset('admin/role/add')}}',600,400)"><i
                                class="layui-icon"></i>添加
                        </button>
                        <span class="layui-layout-right" style="margin-right: 30px">共有数据：<strong>{{count($list)}}</strong> 条</span>
                    </div>
                    <div class="layui-card-body layui-table-body layui-table-main">
                        <table class="layui-table layui-form">
                            <thead>
                            <tr>
                                {{-- <th>
                                     <input type="checkbox" lay-filter="checkall" name="" lay-skin="primary">
                                 </th>--}}
                                <th width="40">ID</th>
                                <th width="200">角色名</th>
                                <th width="300">描述</th>
                                <th width="70">操作</th>
                            </thead>
                            <tbody>
                            @foreach($list as $v)
                                <tr>
                                    {{--<td>
                                        <input type="checkbox" name="id" value="1"   lay-skin="primary">
                                    </td>--}}
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->role_name}}</td>
                                    <td>{{$v->remark}}</td>
                                    <td class="td-manage">
                                        @myAuth('/admin/role/add')
                                        <a title="编辑" onclick="xadmin.open('编辑','{{asset('admin/role/add')}}?id={{$v->id}}',600,400)" href="javascript:;"><i class="icon iconfont" style="font-size: 20px;color: #7197ff;">&#xe63c;</i></a>
                                        @endmyAuth
                                        @myAuth('/admin/role/setMenu')
                                        <a title="授权" onclick="xadmin.open('授权','{{asset('admin/role/setMenu')}}?id={{$v->id}}',600,400)" href="javascript:;"><i class="icon iconfont" style="font-size: 20px;color: #1aff00;">&#xe6a0;</i></a>
                                        @endmyAuth
                                        @myAuth('/admin/role/del')
                                        <a title="删除" onclick="member_del(this,'{{$v->id}}')" href="javascript:;"><i class="icon iconfont" style="font-size: 20px;color: red;">&#xe613;</i></a>
                                        @endmyAuth
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        /*用户-删除*/
        function member_del(obj, id) {
            layer.confirm('角色删除须谨慎，确认要删除吗？', function (index) {
                $.get('/admin/role/del?id='+id,function (re) {
                    if(re.status=='success'){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }else{
                        layer.msg(re.msg,{icon:2,time:3000});
                    }
                });
            });
        }
    </script>
@endsection
