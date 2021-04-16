@extends('web.layout.layout')
@section('css')
    <style>
        .td-manage a {
            margin: 0 5px;
        }
    </style>
@endsection
@section('content')
    <div class="x-nav">
          <span class="layui-breadcrumb">
            <a>首页</a>
            <a>系统管理</a>
            <a>
              <cite>操作日志</cite></a>
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
                        <form class="layui-form layui-col-space5" lay-filter="form1">
                            <div class="layui-inline layui-show-xs-block">
                                <select name="method" lay-verify="">
                                    <option value="">请求方式</option>
                                    <option value="get">get</option>
                                    <option value="post">post</option>
                                </select>
                            </div>

                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="url" placeholder="请求地址" autocomplete="off"
                                       class="layui-input" value="">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="name" placeholder="操作" autocomplete="off"
                                       class="layui-input" value="">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="request" placeholder="请求数据" autocomplete="off"
                                       class="layui-input" value="">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="ip" placeholder="IP" autocomplete="off"
                                       class="layui-input" value="">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="admin_name" placeholder="操作人" autocomplete="off"
                                       class="layui-input" value="">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <label class="layui-form-label" style="padding: 5px 15px">日期范围</label>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <input type="text" name="created_at" class="layui-input" id="test6"
                                           placeholder=" - ">
                                </div>
                            </div>


                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn" lay-submit lay-filter="sreach"><i
                                        class="layui-icon">&#xe615;</i>
                                </button>
                                <button class="layui-btn"><i class="layui-icon">&#xe9aa;</i></button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-body layui-table-body layui-table-main">
                        <table id="table"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        layui.use(['form', 'layer',  'table', 'laydate'],
            function () {
                $ = layui.jquery;
                var form = layui.form;
                var laydate = layui.laydate;
                var table = layui.table;
                var where = {};
                var json = {
                    "title": "", //相册标题
                    "id": 1, //相册id
                    "start": 0, //初始显示的图片序号，默认0
                    "data": []
                };
                form.render();
                laydate.render({
                    elem: '#test6'
                    , range: true
                });
                form.on('submit(sreach)', function (data) {
                    where = data.field;
                    console.log(where);
                    table.reload('exportTable', {
                        where: where
                        , page: {
                            curr: 1 //重新从第 1 页开始
                        }
                    });
                    return false;
                });
                table.render({
                    elem: '#table'
                    , id: 'exportTable'
                    , limit: 15
                    , limits: [15, 30, 60, 90]
                    , loading: true
                    , toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
                    , defaultToolbar: ['filter']
                    , where: where
                    , url:'{{asset('admin/log/list')}}' //数据接口
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: 'ID', }
                        , {field: 'method', title: '请求方式',}
                        , {field: 'url', title: '请求地址', }
                        , {field: 'name', title: '操作',}
                        , {field: 'request', title: '请求数据',}
                        , {field: 'ip', title: 'IP', }
                        , {field: 'admin_name', title: '操作人'}
                        , {field: 'created_at', title: '访问时间 '}
                    ]]
                    , done: function (res, curr, count) {
                    }
                });

            });
    </script>
@endsection
