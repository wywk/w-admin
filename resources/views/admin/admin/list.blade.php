@extends('web.layout.layout')
@section('css')
    <style>
        .td-manage a{
            margin: 0 5px;
        }
    </style>
@endsection
@section('content')
    <div class="x-nav">
          <span class="layui-breadcrumb">
            <a >首页</a>
            <a >管理员管理</a>
            <a>
              <cite>管理员列表</cite></a>
          </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
           onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <form class="layui-form layui-col-space5">
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="key" placeholder="输入管理员名称" autocomplete="off"
                                       class="layui-input" value="{{request()->input('key')}}">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-header">
                        @myAuth('/admin/admin/add')
                        <button class="layui-btn" onclick="xadmin.open('添加管理员','{{asset('admin/admin/add')}}',600,450)"><i
                                class="layui-icon"></i>添加
                        </button>
                        @endmyAuth
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
                                <th width="150">登录名</th>
                                <th width="150">邮箱</th>
                                <th width="200">角色</th>
                                <th width="130">加入时间</th>
                                <th width="100">是否已启用</th>
                                <th width="100">操作</th>
                            </thead>
                            <tbody>
                            @foreach($list as $v)
                                <tr>
                                    {{--<td>
                                        <input type="checkbox" name="id" value="1"   lay-skin="primary">
                                    </td>--}}
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->email}}</td>
                                    <td>{{$v->role->remark}}</td>
                                    <td>{{$v->created_at}}</td>
                                    <td class="td-status">
                                        @if($v->status==1)
                                            <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
                                        @else
                                            <span class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">已停用</span>
                                        @endif

                                    </td>
                                    <td class="td-manage">
                                        @myAuth('/admin/admin/stop')
                                        @if($v->status==1)
                                            <a title="停用" onclick="member_stop(this,'{{$v->id}}')"
                                               href="javascript:;"><i class="icon iconfont" style="font-size: 20px;">&#xe77e;</i></a>
                                        @else
                                            <a title="启用" onclick="member_stop(this,'{{$v->id}}')"
                                               href="javascript:;"><i class="icon iconfont" style="font-size: 20px;">&#xe77d;</i></a>
                                        @endif
                                        @endmyAuth
                                        @myAuth('/admin/admin/add')
                                        <a title="编辑"
                                           onclick="xadmin.open('编辑','{{asset('admin/admin/add')}}?id={{$v->id}}',600,450)"
                                           href="javascript:;"><i class="icon iconfont"
                                                                  style="font-size: 20px;color: #7197ff;">&#xe63c;</i></a>
                                        @endmyAuth
                                        @myAuth('/admin/admin/del')
                                        <a title="删除" onclick="member_del(this,'{{$v->id}}')" href="javascript:;"><i
                                                    class="icon iconfont"
                                                    style="font-size: 20px;color: red;">&#xe613;</i></a>
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
                $.post('{{asset('admin/admin/del')}}',{id:id},function (re) {
                    if(re.status=='success'){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }else{
                        layer.msg(re.msg,{icon:2,time:3000});
                    }
                });
            });
        }

        /*用户-停用*/
        function member_stop(obj,id){
            if($(obj).attr('title')=='停用'){
                var status=0;
            }else{
                var status=1;
            }
            var title=status==1?'启用':'停用';
            layer.confirm('确认要'+title+'吗？',function(index){
                $.post('{{asset('admin/admin/stop')}}',{id:id,status:status},function (re){
                    if (re.status == 'success') {
                        if(status==1){
                            $(obj).attr('title','停用');
                            $(obj).find('i').html('&#xe77e;');
                            $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                        }else{
                            $(obj).attr('title','启用');
                            $(obj).find('i').html('&#xe77d;');
                            $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                        }
                        layer.msg('已'+title+'!', {icon: 6,time:1000});
                    } else {
                        alert(re.msg);
                    }
                });
            });
        }
    </script>
@endsection
