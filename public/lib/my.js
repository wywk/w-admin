$(function () {
    $(".AjaxForm").submit(function (envent) {
        envent.preventDefault();
        var options = {
            success: function (re) {
                if (re.status == 'success') {
                    alert(re.msg);
                    if (re.url) {
                        if(re.url=='-1'){
                            self.location=document.referrer;
                            window.location.href=document.referrer;
                        }else{
                            location.href = re.url;
                        }
                    } else {
                        location.reload();
                    }
                } else {
                    alert(re.msg);
                }
            },
            error: function (error) {
                console.log(error);
            },
            dataType: "json", /*设置返回值类型为文本*/
        }
        $(this).ajaxSubmit(options);
        return false;
    });
});

/**/
function myAjax(msg, url, data) {
    var r = confirm(msg);
    if (r == true) {
        $.ajax({
            type: "get",
            url: url,
            data: data,
            success: function ($re) {
                if ($re.status == 'success') {
                    alert($re.msg);
                    if ($re.url) {
                        location.href = $re.url;
                    } else {
                        location.reload();
                    }
                } else {
                    alert($re.msg);
                }
            },
            error: function () {
                alert(error.msg);
            }
        });
    }
    ;
}

Date.prototype.format = function(fmt) {
    var o = {
        "M+" : this.getMonth()+1,                 //月份
        "d+" : this.getDate(),                    //日
        "h+" : this.getHours(),                   //小时
        "m+" : this.getMinutes(),                 //分
        "s+" : this.getSeconds(),                 //秒
        "q+" : Math.floor((this.getMonth()+3)/3), //季度
        "S"  : this.getMilliseconds()             //毫秒
    };
    if(/(y+)/.test(fmt)) {
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
    }
    for(var k in o) {
        if(new RegExp("("+ k +")").test(fmt)){
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
        }
    }
    return fmt;
}
