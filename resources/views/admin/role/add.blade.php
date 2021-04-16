@extends('web.layout.layout')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            <form class="layui-form">
                <input type="hidden" name="id" value="{{$role->id}}">
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>角色名称：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="role_name" required="" lay-verify="required"
                               autocomplete="off" class="layui-input" value="{{$role->role_name}}">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">
                        <span class="x-red">*</span>备注：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_email" name="remark" required=""
                               autocomplete="off" class="layui-input" value="{{$role->remark}}">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">
                        增加
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>layui.use(['form', 'layer'],
            function () {
                $ = layui.jquery;
                var form = layui.form,
                    layer = layui.layer;
                //自定义验证规则
                //监听提交
                form.on('submit(add)',
                    function (data) {
                        $.post('{{asset('admin/role/add')}}',data.field,function (res) {
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
