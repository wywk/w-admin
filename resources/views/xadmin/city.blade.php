@extends('xadmin.layout')
@section('content')
    <div class="x-nav">
            <span class="layui-breadcrumb">
                <a href="">首页</a>
                <a href="">演示</a>
                <a>
                    <cite>导航元素</cite></a>
            </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
           onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
        </a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <form class="layui-form layui-col-md12  layui-form-pane">
                            <div class="layui-form-item x-city" id="start">
                                <label class="layui-form-label">城市联动</label>
                                <div class="layui-input-inline">
                                    <select name="province" lay-filter="province">
                                        <option value="">请选择省</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select name="city" lay-filter="city">
                                        <option value="">请选择市</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select name="area" lay-filter="area">
                                        <option value="">请选择县/区</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item x-city" id="end">
                                <label class="layui-form-label">城市联动</label>
                                <div class="layui-input-inline">
                                    <select name="province" lay-filter="province">
                                        <option value="">请选择省</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select name="city" lay-filter="city">
                                        <option value="">请选择市</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select name="area" lay-filter="area">
                                        <option value="">请选择县/区</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="layui-card-body ">
<pre class="layui-code" lay-title="JavaScript" lay-skin="notepad">
    //xcity城市插件 基于于jquery与layui form 模块，使用之前先确认这两者是否引入
    //插件文件为 xcity.js,引入
    id所有标签需要有class x-city  id没有根据自己需要定义
    select lay-filter 属性值 为必须 "province/city/area"
    //初始化
    $('#x-city').xcity();
    //传默认值
    $('#x-city').xcity('广东','广州市','东山区');
</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="./js/xcity.js"></script>
    <script>
        layui.use(['form', 'code'], function () {
            form = layui.form;

            layui.code();

            $('#start').xcity();

            $('#end').xcity('广东', '广州市', '东山区');

        });
    </script>
@endsection
