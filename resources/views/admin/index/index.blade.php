<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>{{config('app.name')}}</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="./static/xadmin/css/font.css">
    <link rel="stylesheet" href="./static/xadmin/css/xadmin.css">
    <link rel="stylesheet" href="./static/xadmin/css/theme5.css">
    <!-- <link rel="stylesheet" href="./css/theme5.css"> -->
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./static/xadmin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
    <title>{{config('app.name')}}</title>
    <style>
        .top-nav {
            cursor: pointer;
            width: 100px;
            text-align: center;
        }

        .nav_active {
            background-color: #6385f5;
        }
    </style>
</head>
<body class="index">
<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a>{{config('app.name')}}</a></div>
    {{--<div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>--}}
    <ul class="layui-nav left" lay-filter="">
        @foreach($menu as $v)
            <li class="layui-nav-item top-nav" data-id="{{$v['id']}}">{{$v['menu_name']}}</li>
        @endforeach
    </ul>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">{{auth()->user()->name}}</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('个人信息','{{asset('admin/admin/password')}}',500,400)">修改密码</a>
                </dd>
                <dd>
                    <a href="{{asset('logout')}}">退出</a></dd>
            </dl>
        </li>
        {{--<li class="layui-nav-item to-index">
            <a href="/">前台首页</a></li>--}}
    </ul>
</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        @foreach($menu as $v)
            @isset($v['children'])
                <ul class="ul_nav" id="ul_nav_{{$v['id']}}" style="display: none">
                    @foreach($v['children'] as $vv1)
                        <li>
                            @isset($vv1['children'])
                                <a href="javascript:">
                                    <i class="iconfont left-nav-li" lay-tips="{{$vv1['menu_name']}}">{!! $vv1['icon'] !!}</i>
                                    <cite>{{$vv1['menu_name']}}</cite>
                                    <i class="iconfont nav_right">&#xe697;</i>
                                </a>
                                <ul class="sub-menu">
                                    @foreach($vv1['children'] as $v2)
                                        @isset($v2['children'])
                                            <li>
                                                <a href="javascript:">
                                                    <i class="iconfont">{!! $v2['icon'] !!}</i>
                                                    <cite>{{$v2['menu_name']}}</cite>
                                                    <i class="iconfont nav_right">&#xe697;</i></a>
                                                <ul class="sub-menu">
                                                    @foreach($v2['children'] as $v3)
                                                        @isset($v3['children'])
                                                            <li>
                                                                <a href="javascript:">
                                                                    <i class="iconfont">{!! $v3['icon'] !!}</i>
                                                                    <cite>{{$v3['menu_name']}}</cite>
                                                                    <i class="iconfont nav_right">&#xe697;</i></a>
                                                                <ul class="sub-menu">
                                                                    @foreach($v3['children'] as $v4)
                                                                        <li>
                                                                            <a style="padding: 12px 15px 12px 60px;" class="add_tab" onclick="xadmin.add_tab('{{$v4["menu_name"]}}','{{asset($v4["url"])}}',true)">
                                                                                <i class="iconfont">{!! $v4['icon'] !!}</i>
                                                                                <cite>{{$v4["menu_name"]}}</cite></a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a onclick="xadmin.add_tab('{{$v3["menu_name"]}}','{{asset($v3["url"])}}',true)" class="add_tab">
                                                                    <i class="iconfont">{!! $v3['icon'] !!}</i>
                                                                    <cite>{{$v3["menu_name"]}}</cite></a>
                                                            </li>
                                                        @endisset
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a onclick='xadmin.add_tab("{{$v2['menu_name']}}","{{asset($v2['url'])}}",true)' class="add_tab">
                                                    <i class="iconfont">{!! $v2['icon'] !!}</i>
                                                    <cite>{{$v2['menu_name']}}</cite></a>
                                            </li>
                                        @endisset
                                    @endforeach
                                </ul>
                            @else
                                <a onclick="xadmin.add_tab('{{$vv1["menu_name"]}}','{{asset($vv1["url"])}}',true)">
                                    <i class="iconfont">{!! $vv1['icon'] !!}</i>
                                    <cite>{{$vv1["menu_name"]}}</cite></a>
                            @endisset
                        </li>
                    @endforeach
                </ul>
            @else
                <a onclick="xadmin.add_tab('{{$v["menu_name"]}}','{{asset($v["url"])}}',true)" id="a_nav_{{$v['id']}}" style="display: none"></a>
            @endisset
        @endforeach
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li class="home">
                <i class="layui-icon">&#xe68e;</i>我的桌面
            </li>
        </ul>
        <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
            <dl>
                <dd data-type="this">关闭当前</dd>
                <dd data-type="other">关闭其它</dd>
                <dd data-type="all">关闭全部</dd>
            </dl>
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='./admin/admin/welcome' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
        <div id="tab_show"></div>
    </div>
</div>
<div class="page-content-bg"></div>
<style id="theme_style"></style>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
</body>
<script src="./lib/jquery/1.9.1/jquery.js"></script>
<script>
    $('.top-nav').click(function (e) {
        let id = $(this).attr('data-id');
        let left_e = $('#ul_nav_' + id);
        $('.top-nav').removeClass('nav_active');
        $(this).addClass('nav_active');
        console.log(left_e.length);
        if (left_e.length > 0) {
            $('.ul_nav').hide();
            left_e.show();
            $('.left-nav').animate({width: '220px'}, 100);
            $('.page-content').animate({left: '220px'}, 100);
            $('.left-nav i').css('font-size', '14px');
            $('.left-nav cite,.left-nav .nav_right').show();
            if ($(window).width() < 768) {
                $('.page-content-bg').show();
            }
        } else {
            $('.left-nav .open').click();
            $('.left-nav i').css('font-size', '18px');
            $('.left-nav').animate({width: '0px'}, 100);
            $('.left-nav cite,.left-nav .nav_right').hide();
            $('.page-content').animate({left: '0px'}, 100);
            $('.page-content-bg').hide();
            $('#a_nav_' + id).trigger('click');
        }
        console.log(left_e.find('.add_tab'));
    });
    $('.top-nav').first().trigger('click');

</script>
</html>
