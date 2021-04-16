@extends('web.layout.layout')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            <form class="layui-form" lay-filter="form1">
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>管理员：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username"  required="" lay-verify="required"
                               autocomplete="off" class="layui-input" value="{{session('user.name')}}" readonly>
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        登录帐号
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        邮箱：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="email" required="" lay-verify="required"
                               autocomplete="off" class="layui-input" value="{{session('user.email')}}">
                    </div>
                    <div class="layui-form-mid layui-word-aux">

                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>旧密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="old_password"  lay-verify="required" autocomplete="off" class="layui-input" >
                    </div>
                    <div class="layui-form-mid layui-word-aux">6到16个字符</div>
                </div>

                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>新密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="password" lay-verify="pass" lay-verify="required" autocomplete="off" class="layui-input" >
                    </div>
                    <div class="layui-form-mid layui-word-aux">6到16个字符</div>
                </div>

                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                        <span class="x-red">*</span>确认密码</label>
                    <div class="layui-input-inline">
                        <input type="password"  name="password2" lay-verify="required" autocomplete="off" class="layui-input" >
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
    <script>layui.use(['form', 'layer'],
            function () {
                $ = layui.jquery;
                var form = layui.form,
                    layer = layui.layer;
                form.render();
                form.verify({
                    pass: function(value, item){ //value：表单的值、item：表单的DOM对象
                        if(value!=form.val('form1').password2){
                            return '两次密码不一样！';
                        }
                    }
                });
                //自定义验证规则
                //监听提交
                form.on('submit(add)',
                    function (data) {
                        $.post('{{asset('admin/admin/password')}}',data.field,function (res) {
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
            });
    </script>
@endsection
