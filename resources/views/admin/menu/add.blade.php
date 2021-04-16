@extends('web.layout.layout')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            <form class="layui-form">
                <input type="hidden" name="id" value="{{$info->id}}">
                <input type="hidden" name="pid" value="{{$info->pid}}">
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>上级菜单：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" value="{{$pname}}" readonly>
                    </div>
                    {{--<div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>--}}
                </div>
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>节点名称：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="menu_name" required="" lay-verify="required"
                               autocomplete="off" class="layui-input" value="{{$info->menu_name}}" placeholder="请输入节点名称">
                    </div>
                    {{--<div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>--}}
                </div>

                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        图标：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="icon" required=""
                                class="layui-input" value="{{$info->icon}}" placeholder="请输入图标">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <a title="查看图标"  href="/static/xadmin/fonts/demo_index.html" target="_blank"><i class="icon iconfont" style="font-size: 20px;color: #ffae8f;">&#xe657;</i></a>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        url：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="url" required="" class="layui-input" value="{{$info->url}}" placeholder="请输入url地址">
                    </div>
                   {{-- <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>--}}
                </div>

                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        说明：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="remark" required=""  class="layui-input" value="{{$info->remark}}" placeholder="请输入说明">
                    </div>
                    {{--<div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>--}}
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">是否显示：</label>
                    <div class="layui-input-block" style="padding-top: 9px">
                        <input type="checkbox" name="is_show" lay-skin="switch" value="1" @if($info->is_show) checked @endif>
                    </div>
                </div>


                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">
                        提交
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        layui.use(['form', 'layer'],
            function () {
                $ = layui.jquery;
                var form = layui.form,
                    layer = layui.layer;
                form.on('submit(add)',
                    function (data) {
                        $.post('{{asset('admin/menu/edit')}}',data.field,function (res) {
                            if(res.status=='success'){
                                layer.alert(res.msg,{icon:6},function () {
                                    //关闭当前frame
                                    xadmin.close();
                                    // 可以对父窗口进行刷新
                                    xadmin.father_reload();
                                })
                            }else{
                                layer.alert(res.msg,{icon:5});
                            }
                        });
                        return false;
                    });
            });</script>
@endsection
