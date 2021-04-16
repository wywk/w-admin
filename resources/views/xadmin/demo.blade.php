@extends('xadmin.layout')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <a onclick="parent.xadmin.add_tab('在tab打开','https://www.baidu.com',true)" style="color: red"
                           href="javascript:;">iframe页面中打开tab事例</a>
                        <br>
                        <a onclick="parent.xadmin.add_tab('在tab打开','https://www.baidu.com')" style="color: red"
                           href="javascript:;">iframe页面中打开tab事例(重复点击不刷新)</a>
                        <br>
                        <a onclick="xadmin.open('iframe页面中打开open事例','https://www.163.com')" style="color: red"
                           href="javascript:;">iframe页面中打开open事例</a>
                        <br>
                        <a onclick="parent.xadmin.open('在上一级窗口打开open事件','http://www.baidu.com')" style="color: red"
                           href="javascript:;">在上一级窗口打开open事件</a>
                        <br>
                        <a onclick="xadmin.del_tab()" style="color: red" href="javascript:;">在子页面关闭自己本身tab</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
@endsection
