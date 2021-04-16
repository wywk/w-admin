@extends('web.layout.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('lib/zTree/v3/css/zTreeStyle/zTreeStyle.css')}}">
    <style>
        .ztree * {
            font-size: 16px;
        }

        .ztree li span {
            line-height: 20px;
        }

        .ztree li a {
            height: 21px;
        }
        .ztree li a.curSelectedNode {
            height: 25px;
        }
        .ztree li span.button.remove {
            margin-left: 5px;
            margin-top: 4px;
        }
    </style>
@endsection
@section('content')
    <div class="x-nav">
          <span class="layui-breadcrumb">
            <a>首页</a>
            <a>管理员管理</a>
            <a>
              <cite>授权</cite></a>
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
                        <form class="layui-form layui-col-space5">
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" id="key" name="username" placeholder="请输入菜单名" autocomplete="off"
                                       class="layui-input">
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-body">
                        <div id="treeDemo" class="ztree"></div>

                    </div>
                </div>
                <div class="layui-card-body">
                    <button class="layui-btn layui-btn-radius layui-btn-normal" onclick="save()"><i class="icon iconfont" style="color: #1aff00;">&#xe6a0;</i>确定授权
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('lib/zTree/v3/js/jquery-1.4.4.min.js')}}"></script>
    <script src="{{asset('lib/zTree/v3/js/jquery.ztree.all.min.js')}}"></script>
    <script src="{{asset('lib/zTree/v3/js/jquery.ztree.exhide.min.js')}}"></script>
    <script src="{{asset('lib/zTree/v3/demo/js/fuzzysearch.min.js')}}"></script>
    <script>
        var setting = {
            check: {
                enable: true,
                nocheckInherit: true,
                chkboxType: {"Y": "ps", "N": "s"},
            },
            view:{
                fontCss: getFont,
            },
        };

        var zNodes = {!! json_encode($list) !!};
        var treeObj;
        function getFont(treeId, node) {
            return node._show ? {'color':'red'} : {'font-style':'italic'};
        }
        function save(){
            var nodes = treeObj.getChangeCheckedNodes();
            var check_ids='';
            var nocheck_ids='';
            for (index in nodes){
                if(nodes[index].checked){
                    check_ids+=check_ids?","+nodes[index].id:nodes[index].id;
                }else{
                    nocheck_ids+=nocheck_ids?","+nodes[index].id:nodes[index].id;
                }

            }
            let l1=layer.confirm('确定更改授权?', function (index) {
                layer.close(l1);
                var data={id:{{$id}},check_ids:check_ids,nocheck_ids:nocheck_ids};
                $.post('{{asset('admin/role/setMenu')}}',data,function (res) {
                    if(res.status==='success'){
                        location.reload();
                    }else{
                        layer.alert(res.msg,{icon:5});
                    }
                });
            });
        };
        $(document).ready(function () {
            $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            fuzzySearch('treeDemo','#key',null,true); //初始化模糊搜索方法
            treeObj = $.fn.zTree.getZTreeObj("treeDemo");
        });

    </script>
@endsection
