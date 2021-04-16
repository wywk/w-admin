layui.use(['form', 'layer', 'upload', 'table', 'laydate'],
    function () {
        $ = layui.jquery;
        var form = layui.form;
        var upload = layui.upload;
        var laydate = layui.laydate;
        var table = layui.table;
        var where = {};
        var json = {
            "title": "", //相册标题
            "id": 1, //相册id
            "start": 0, //初始显示的图片序号，默认0
            "data": []
        };
        var fileList = JSON.parse(localStorage.getItem("fileList"));
        if (!fileList) {
            fileList = {
                'id': false,
                'origin_name': false,
                'path': true,
                'size_show': false,
                'ext': true,
                'identify_progress_name': false,
                'type_name': false,
                'created_at': false,
            };
        }
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
        table.on('toolbar()', function (obj) {
            console.log(obj.event);
            if (obj.event === 'LAYTABLE_COLS') {
                $('.layui-table-tool-panel').click(function () {
                    $('.layui-table-tool-panel li').each(function (i, v) {
                        fileList[$(v).find('input').attr('name')] = $(v).find('.layui-form-checked').length === 0;
                    });
                    localStorage.setItem('fileList', JSON.stringify(fileList));
                });
            }

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
            , url: '/admin/file/list' //数据接口
            , page: true //开启分页
            , cols: [[ //表头
                {field: 'id', title: 'ID', hide: fileList.id}
                , {field: 'origin_name', title: '原文件名', hide: fileList.origin_name}
                , {field: 'path', title: '附件地址', hide: fileList.path}
                , {field: 'size_show', title: '文件大小', hide: fileList.size_show}
                , {field: 'ext', title: '文件后缀', hide: fileList.ext}
                , {field: 'identify_progress_name', title: '识别进度', hide: fileList.identify_progress_name}
                , {field: 'type_name', title: '发票类型', hide: fileList.type_name}
                , {field: 'created_at', title: '创建时间 ', hide: fileList.created_at}
                , {
                    field: 'id', title: '操作', templet: function (d) {
                        let html = '<span data-id="' + d.LAY_TABLE_INDEX + '" class="layui-btn layui-btn-sm layui-btn-normal show_img">查看</span>';
                        html += '<a href="/' + d.path + '" target="_blank" class="layui-btn layui-btn-sm" download="' + d.origin_name + '">下载</a>';
                        if (d.identify_progress !== 3 && d.identify_progress !== 4) {
                            html += '<span data-id="' + d.id + '" class="layui-btn layui-btn-sm layui-btn-warm re_identify">识别</span>';
                            html += '<span data-id="' + d.id + '" class="layui-btn layui-btn-sm layui-btn-danger delete_img">删除</span>';
                        }
                        if (d.identify_progress === 4) {
                            html += '<span data-id="' + d.id + '" class="layui-btn layui-btn-sm layui-btn-danger delete_img">删除</span>';
                        }
                        return html
                    }, width: 250
                },
            ]]
            , done: function (res, curr, count) {
                $('#size').html(res.sum_size);
                json.data = [];
                for (let i in res.data) {
                    json.data.push({
                        "alt": res.data[i].origin_name,
                        "pid": res.data[i].id, //图片id
                        "src": '/' + res.data[i].img_path, //原图地址
                        "thumb": '/' + res.data[i].img_path //缩略图地址
                    });
                }
                console.log(json);
                $('.show_img').click(function () {
                        json.start = $(this).attr('data-id');
                        console.log(json);
                        layer.photos({
                            photos: json //格式见API文档手册页
                            , anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机
                        });

                    }
                )
                //重新识别
                $('.re_identify').click(function () {
                    let id = $(this).attr('data-id');
                    layer.load();
                    $.post('/admin/file/re_identify', {id: id}, function (res) {
                        if (res.code === 0) {
                            layer.msg('识别成功', {icon: 1});
                            table.reload('exportTable', {
                                where: where
                                , page: {
                                    curr: 1 //重新从第 1 页开始
                                }
                            });
                            layer.closeAll('loading');
                        } else {
                            layer.msg('识别失败', {icon: 2});
                            layer.closeAll('loading');
                        }
                    })
                });
                //删除文件
                $('.delete_img').click(function () {
                    let id = $(this).attr('data-id');
                    layer.confirm('你确定要删除此文件吗？', {
                        btn: ['确定', '取消'] //按钮
                    }, function () {
                        $.post('/admin/file/delete_img', {id: id}, function (res) {
                            if (res.code === 0) {
                                layer.msg('删除成功', {icon: 1});
                                table.reload('exportTable', {
                                    where: where
                                    , page: {
                                        curr: 1 //重新从第 1 页开始
                                    }
                                });
                            } else {
                                layer.msg('删除失败', {icon: 2});
                            }
                        })
                    })
                });
            }
        });

    });

