@extends('web.layout.layout')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            <form class="layui-form" lay-filter="form1">
                <input type="hidden" name="id" value="{{$admin->id}}">
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>管理员：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="name" required="" lay-verify="required"
                               autocomplete="off" class="layui-input" value="{{$admin->name}}">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        登录帐号
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>真实姓名：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="true_name" name="true_name"
                               autocomplete="off" class="layui-input" value="{{$admin->true_name}}"
                               lay-verify="required">
                    </div>
                    <div class="layui-form-mid layui-word-aux">

                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>邮箱：
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="email" required="" lay-verify="required"
                               autocomplete="off" class="layui-input" value="{{$admin->email}}">
                    </div>
                    <div class="layui-form-mid layui-word-aux">

                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>新密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="password" lay-verify="pass" lay-verify="required"
                               autocomplete="off" class="layui-input"
                               value="{{ $admin->password?decrypt($admin->password):'' }}">
                    </div>
                    <div class="layui-form-mid layui-word-aux">6到16个字符</div>
                </div>

                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                        <span class="x-red">*</span>确认密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="password2" lay-verify="required" autocomplete="off"
                               class="layui-input" value="{{$admin->password?decrypt($admin->password):'' }}">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">角色：</label>
                    <div class="layui-input-inline">
                        <select name="role_id" lay-filter="role_id">
                            @foreach($roles as $v)
                                <option value="{{$v->id}}">{{$v->role_name}}</option>
                            @endforeach
                        </select>
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
                $("[name='role_id']").val({{$admin->role_id}});
                form.render();
                form.verify({
                    pass: function (value, item) { //value：表单的值、item：表单的DOM对象
                        if (value != form.val('form1').password2) {
                            return '两次密码不一样！';
                        }
                    }
                });

                //自定义验证规则
                //监听提交
                form.on('submit(add)',
                    function (data) {
                        var zzk_project_arr = data.field.zzk_project.split(",");
                        data.field.zzk_project_id = zzk_project_arr[0];
                        data.field.zzk_project_name = zzk_project_arr[1];
                        $.post('/admin/admin/add', data.field, function (res) {
                            if (res.status == 'success') {
                                layer.alert(res.msg, {icon: 6}, function () {
                                    //关闭当前frame
                                    xadmin.close();
                                    // 可以对父窗口进行刷新
                                    xadmin.father_reload();
                                })
                            } else {
                                layer.alert(res.msg, {icon: 5});
                            }
                        });
                        return false;
                    });
            });
    </script>
@endsection
