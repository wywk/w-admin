@extends('web.layout.layout')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <blockquote class="layui-elem-quote">欢迎管理员：
                            <span class="x-red">{{auth()->user()->name}}</span>！当前时间:{{date('Y-m-d H:i:s')}}
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">数据统计</div>
                    <div class="layui-card-body ">
                        <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                            @foreach($list as $v)
                            <li class="layui-col-md2 layui-col-xs6">
                                <a href="javascript:;" class="x-admin-backlog-body">
                                    <h3>{!! $v['identify_progress_name'] !!}</h3>
                                    <p>
                                        <cite>{{$v['sum']}}</cite></p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <style id="welcome_style"></style>
            <div class="layui-col-md12">
                <blockquote class="layui-elem-quote layui-quote-nm"></blockquote>
            </div>
        </div>
    </div>
    </div>
@endsection
