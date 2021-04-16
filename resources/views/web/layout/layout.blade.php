<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>欢迎页面-{{config('app.name')}}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <meta name="x-csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('static/xadmin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('static/xadmin/css/xadmin.css')}}">
    <script src="{{asset('lib/layui/layui.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/xadmin/js/xadmin.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
</head>
<body>
@yield('content')
</body>
<script>
    var header = {};
    layui.use(['jquery', 'layer'], function () {
        var $ = layui.$ //重点处
            , layer = layui.layer;
        header = {'X-CSRF-TOKEN': $("meta[name='x-csrf-token']").attr('content')}
        $.ajaxSetup({
            headers: header
        });
    });

</script>
@yield('js')
</html>
