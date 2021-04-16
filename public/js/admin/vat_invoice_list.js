layui.use(['form', 'layer', 'upload', 'table', 'laydate'],
    function () {
        $ = layui.jquery;
        var form = layui.form;
        var upload = layui.upload;
        var table = layui.table;
        var where = {};
        var laydate = layui.laydate;
        var vatInvoiceList = JSON.parse(localStorage.getItem("vatInvoiceList"));
        laydate.render({
            elem: '#invoice_date'
            , range: true
        });
        laydate.render({
            elem: '#created_at'
            , range: true
        });
        if (!vatInvoiceList) {
            vatInvoiceList = {
                'id': true,
                'file_id': true,
                'invoice_type': false,
                'invoice_type_org': true,
                'invoice_code': false,
                'invoice_num': false,
                'check_code': false,
                'invoice_date': false,
                'purchaser_name': true,
                'purchaser_register_num': true,
                'purchaser_address': true,
                'purchaser_bank': true,
                'password': true,
                'seller_name': true,
                'seller_register_num': true,
                'seller_address': true,
                'seller_bank': true,
                'total_amount': true,
                'total_tax': true,
                'amount_in_words': true,
                'amount_in_figuers': false,
                'payee': false,
                'checker': false,
                'note_drawer': false,
                'remarks': false,
                'created_at': false,
            };
        }
        form.render();
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
                        vatInvoiceList[$(v).find('input').attr('name')] = $(v).find('.layui-form-checked').length === 0;
                    });
                    localStorage.setItem('vatInvoiceList', JSON.stringify(vatInvoiceList));
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
            , url: '/admin/vatInvoice/list' //数据接口
            , page: true //开启分页
            , cols: [[ //表头
                {field: 'id', title: 'ID', width: 5, hide: vatInvoiceList.id}
                , {field: 'invoice_num', title: '发票号码', hide: vatInvoiceList.invoice_num}
                , {field: 'invoice_code', title: '发票代码', hide: vatInvoiceList.invoice_code}
                , {field: 'file_id', title: '图片ID', hide: vatInvoiceList.file_id}
                , {field: 'invoice_type', title: '发票种类', hide: vatInvoiceList.invoice_type}
                , {field: 'invoice_type_org', title: '发票名称', hide: vatInvoiceList.invoice_type_org}
                , {field: 'check_code', title: '校验码', hide: vatInvoiceList.check_code}
                , {field: 'invoice_date', title: '开票日期', hide: vatInvoiceList.invoice_date}
                , {field: 'purchaser_name', title: '购方名称', hide: vatInvoiceList.purchaser_name}
                , {
                    field: 'purchaser_register_num',
                    title: '购方纳税人识别号',
                    hide: vatInvoiceList.purchaser_register_num
                }
                , {field: 'purchaser_address', title: '购方地址及电话', hide: vatInvoiceList.purchaser_address}
                , {field: 'purchaser_bank', title: '购方开户行及账号', hide: vatInvoiceList.purchaser_bank}
                , {field: 'password', title: '密码区', hide: vatInvoiceList.password}
                , {field: 'seller_name', title: '销售方名称', hide: vatInvoiceList.seller_name}
                , {field: 'seller_register_num', title: '销售方纳税人识别号', hide: vatInvoiceList.seller_register_num}
                , {field: 'seller_address', title: '销售方地址及电话', hide: vatInvoiceList.seller_address}
                , {field: 'seller_bank', title: '销售方开户行及账号', hide: vatInvoiceList.seller_bank}
                , {field: 'total_amount', title: '金额', hide: vatInvoiceList.total_amount}
                , {field: 'total_tax', title: '税额', hide: vatInvoiceList.total_tax}
                , {field: 'amount_in_words', title: '价税合计(大写)', hide: vatInvoiceList.amount_in_words}
                , {field: 'amount_in_figuers', title: '价税合计(小写)', hide: vatInvoiceList.amount_in_figuers}
                , {field: 'payee', title: '收款人', hide: vatInvoiceList.payee}
                , {field: 'checker', title: '复核', hide: vatInvoiceList.checker}
                , {field: 'note_drawer', title: '开票人', hide: vatInvoiceList.note_drawer}
                , {field: 'remarks', title: '备注', hide: vatInvoiceList.remarks}
                , {field: 'created_at', title: '创建时间 ', hide: vatInvoiceList.created_at}
                , {
                    field: '', title: '操作', templet: function (d) {
                        let html='<span onclick="xadmin.open(\'编辑\',\'/admin/vat_invoice/edit?id=' + d.id + '\')" class="layui-btn layui-btn-sm layui-btn-normal">修改</span>';
                        html+='<span data-id="'+d.id+'" class="layui-btn layui-btn-sm layui-btn-danger del">删除</span>';
                        return  html
                    }, width: 150
                },
            ]]
            , done: function (res, curr, count) {
                $('#total_amount').html(res.total_amount);
                $('#total_tax').html(res.total_tax);
                $('#amount_in_figuers').html(res.amount_in_figuers);
                var uploadInst = upload.render({
                    elem: '#test1' //绑定元素
                    , url: '/admin/file/upload' //上传接口
                    , accept: 'file'
                    , data: {type: 1}
                    , acceptMime: "image/*,application/pdf"
                    , multiple: true
                    , headers: header
                    , allDone: function (obj) { //当文件全部被提交后，才触发
                        console.log(obj.total); //得到总文件数
                        console.log(obj.successful); //请求成功的文件数
                        console.log(obj.aborted); //请求失败的文件数
                        layer.alert('上传成功' + obj.successful + "个文件", {icon: 6}, function () {
                            location.reload();
                        })
                    }
                    , error: function () {
                        //请求异常回调
                    }
                });
                $('.del').click(function () {
                    let id = $(this).attr('data-id');
                    layer.confirm('你确定要删除此数据吗？', {
                        btn: ['确定', '取消'] //按钮
                    }, function () {
                        $.post('/admin/vat_invoice/delete', {id: id}, function (res) {
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
