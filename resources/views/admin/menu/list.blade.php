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
            <a>系统设置</a>
            <a>
              <cite>菜单列表</cite></a>
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
                        @myAuth('/admin/menu/edit')
                        <button class="layui-btn" onclick="xadmin.open('添加','{{asset('admin/menu/edit')}}',500,500)"><i
                                class="layui-icon"></i>添加一级菜单
                        </button>
                        @endmyAuth
                    </div>
                    <div class="layui-card-body">
                        <div id="treeDemo" class="ztree"></div>
                    </div>
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
            view: {
                addHoverDom: addHoverDom,
                removeHoverDom: removeHoverDom,
                selectedMulti: false,
                fontCss: getFont,
            },
            callback: {
                onDrop: onDrop,
                onRemove: onRemove,
            },
            edit: {
                enable: true,
                showRenameBtn: false,
                showRemoveBtn: setRemoveBtn,
                drag: {
                    isCopy: false,
                    @myAuth('/admin/menu/editSort')
                    isMove: true,
                    @else
                    isMove: false,
                    @endmyAuth
                },

            }
        };

        var zNodes = {!! json_encode($list) !!};
        var log, className = "dark";

        function getFont(treeId, node) {
            return node._show ? {'color': 'red'} : {'font-style': 'italic'};
        }

        function onDrop(event, treeId, treeNodes, targetNode, moveType) {
            $.post('{{asset('admin/menu/editSort')}}', {id: treeNodes[0]['id'], target_id: targetNode['id'], 'type': moveType})
        }

        function onRemove(event, treeId, treeNode) {
            $.post('{{asset('admin/menu/del')}}', {id: treeNode['id']})
        }

        function setRemoveBtn(treeId, treeNode) {
            @myAuth('/admin/menu/del')
                return !treeNode.isParent;
            @endmyAuth
            return false;
        }

        function onRename(e, treeId, treeNode, isCancel) {
            showLog((isCancel ? "<span style='color:red'>" : "") + "[ " + getTime() + " onRename ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name + (isCancel ? "</span>" : ""));
        }

        function showRemoveBtn(treeId, treeNode) {
            return !treeNode.isFirstNode;
        }

        function showRenameBtn(treeId, treeNode) {
            return !treeNode.isLastNode;
        }

        function getTime() {
            var now = new Date(),
                h = now.getHours(),
                m = now.getMinutes(),
                s = now.getSeconds(),
                ms = now.getMilliseconds();
            return (h + ":" + m + ":" + s + " " + ms);
        }

        var newCount = 1;

        function addHoverDom(treeId, treeNode) {
            var sObj = $("#" + treeNode.tId + "_span");
            if (treeNode.editNameFlag || $("#editBtn_" + treeNode.tId).length > 0) return;
            @myAuth('/admin/menu/edit')
            var addStr = "<a title='编辑' style='padding-top: 4px;' id='editBtn_" + treeNode.tId + "' onclick=\"" +
                "xadmin.open(\'编辑\',\'{{asset('admin/menu/edit')}}?id=" + treeNode.id + '\',500,500)\" ' +
                "href='javascript:;'><i class='icon iconfont' style='font-size: 16px;color: #7197ff;'>&#xe63c;</i></a>";
            sObj.after(addStr);
            var addStr = "<a title='添加' style='padding-top: 4px;margin: 0 5px;' id='addBtn_" + treeNode.tId + "' onclick=\"" +
                "xadmin.open(\'编辑\',\'{{asset('admin/menu/edit')}}?pid=" + treeNode.id + '\',500,500)\" ' +
                "href='javascript:;'><i class='icon iconfont' style='font-size: 16px;color: #7197ff;'>&#xe617;</i></a>";
            sObj.after(addStr);
            @endmyAuth
        };

        function removeHoverDom(treeId, treeNode) {
            $("#addBtn_" + treeNode.tId).unbind().remove();
            $("#editBtn_" + treeNode.tId).unbind().remove();
        };

        function selectAll() {
            var zTree = $.fn.zTree.getZTreeObj("treeDemo");
            zTree.setting.edit.editNameSelectAll = $("#selectAll").attr("checked");
        }

        $(document).ready(function () {
            $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            fuzzySearch('treeDemo', '#key', null, true); //初始化模糊搜索方法
        });

    </script>
@endsection
