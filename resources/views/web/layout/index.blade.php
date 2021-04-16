<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="favicon.ico" >
    <link rel="Shortcut Icon" href="favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin.pro.iframe/css/h-ui.admin.pro.iframe.min.css" />
    <link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.9/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin.pro.iframe/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="static/business/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->

    <title>至尊商务版本更新系统</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
</head>
<body>
<!--_menu 作为公共模版分离出去-->
<aside class="Hui-admin-aside-wrapper">
    <div class="Hui-admin-logo-wrapper">
        <a class="logo navbar-logo" href="/">
            <i class="va-m iconpic global-logo"></i>
            <span class="va-m">至尊商务版本更新系统</span>
        </a>
    </div>
    <div class="Hui-admin-menu-dropdown bk_2">
        <dl id="menu-home" class="Hui-menu">
            <dd class="Hui-menu-item-frist">
                <ul>
                    <li><a data-href="_blank" data-title="首页" href="javascript:void(0)"><i class="Hui-iconfont">&#xe616;</i>&nbsp; 首页</a></li>
                </ul>
            </dd>
        </dl>
        @foreach($menu as $v)
            <dl id="menu-article" class="Hui-menu">
                <dt class="Hui-menu-title"><i class="Hui-iconfont">{!! $v['icon'] !!}</i> {{$v['menu_name']}}<i class="Hui-iconfont Hui-admin-menu-dropdown-arrow"></i>
                </dt>
                @isset($v['children'])
                <dd class="Hui-menu-item">
                    <ul>
                        @foreach($v['children'] as $v2)
                            @isset($v2['children'])
                                <li>
                                    <dl class="Hui-menu">
                                        <dt class="Hui-menu-title">{{$v2['menu_name']}}<i class="Hui-iconfont Hui-admin-menu-dropdown-arrow">{{$v2['icon']}}</i></dt>
                                        <dd class="Hui-menu-item">
                                            <ul>
                                                @foreach($v2['children'] as $v3)
                                                    <li><a data-href="{{asset($v3['url'])}}" data-title="{{$v3['menu_name']}}" href="javascript:void(0)">{{$v3['menu_name']}}</a></li>
                                                @endforeach
                                            </ul>
                                        </dd>
                                    </dl>
                                </li>
                            @else
                                <li><a data-href="{{asset($v2['url'])}}" data-title="{{$v2['menu_name']}}" href="javascript:void(0)">{{$v2['menu_name']}}</a></li>
                            @endisset
                        @endforeach
                    </ul>
                </dd>
                @endisset
            </dl>
        @endforeach
    </div>
</aside>
<div class="Hui-admin-aside-mask"></div>
<!--/_menu 作为公共模版分离出去-->

<div class="Hui-admin-dislpayArrow">
    <a href="javascript:void(0);" onClick="displaynavbar(this)">
        <i class="Hui-iconfont Hui-iconfont-left">&#xe6d4;</i>
        <i class="Hui-iconfont Hui-iconfont-right">&#xe6d7;</i>
    </a>
</div>

<section class="Hui-admin-article-wrapper">
    <!--_header 作为公共模版分离出去-->
    <header class="Hui-navbar">
        <div class="navbar">
            <div class="container-fluid clearfix">
                {{--<nav id="Hui-topNav" class="nav navbar-nav">
                    <ul class="clearfix">
                        <li><a data-href="article-add" data-title="新增资讯" onclick="Hui_admin_tab(this)" href="javascript:;">新增资讯</a></li>
                        <li class="dropDown dropDown_hover">
                            <a class="dropDown_A" href="javascript:;">顶部菜单</a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li class="">
                                    <a href="#">二级导航</a>
                                </li>
                                <li class="">
                                    <a href="#">二级导航</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>--}}
                <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar">
                    <ul class="clearfix">
                       {{-- <li>超级管理员</li>--}}
                        <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A">{{auth()->user()->name}} <i class="Hui-iconfont">&#xe6d5;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                               {{-- <li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>--}}
                                <li><a href="/logout">退出</a></li>
                            </ul>
                        </li>
                        <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
                        <li id="Hui-skin" class="dropDown dropDown_hover right">
                            <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li><a href="javascript:;" data-val="default" title="默认（蓝色）">默认（深蓝）</a></li>
                                <li><a href="javascript:;" data-val="black" title="黑色">黑色</a></li>
                                <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                                <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                                <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                                <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!--/_header 作为公共模版分离出去-->

    <div id="Hui-admin-tabNav" class="Hui-admin-tabNav">
        <div class="Hui-admin-tabNav-wp">
            <ul id="min_title_list" class="acrossTab clearfix" style="width: 241px; left: 0px;">
                <li class="active"><span title="我的桌面" data-href="welcome">我的桌面</span><em></em></li>
            </ul>
        </div>
        <div class="Hui-admin-tabNav-more btn-group" style="display: none;">
            <a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a>
            <a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a>
        </div>
    </div>

    <div id="iframe_box" class="Hui-admin-article">
        <div class="show_iframe">
            <iframe id="iframe-welcome" data-scrolltop="0" scrolling="yes" frameborder="0" src="welcome"></iframe>
        </div>
    </div>
</section>
<div class="contextMenu" id="Huiadminmenu">
    <ul>
        <li id="closethis">关闭当前 </li>
        <li id="closeother">关闭其他 </li>
        <li id="closeall">关闭全部 </li>
    </ul>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/3.1.1/layer.js"></script>
<script type="text/javascript" src="static/h-ui.admin.pro.iframe/js/h-ui.admin.pro.iframe.min.js"></script>
<script type="text/javascript" src="lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="static/business/js/main.js"></script>
</body>
</html>
