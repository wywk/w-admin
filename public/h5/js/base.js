/**toast组件
 * content 内容必填
 * time 多久自动消失
 * */
let utils_toast = (function () {

    // 节点类型
    let elem, toast;

    /**
     * @method getNeedElement 获取所需要的节点
     */
    let getNeedElement = function () {
        // 一家人最重要是整整齐齐
        elem = document.querySelector('.toast-wrapper');
        toast = elem.querySelector('.toast');
    };

    let show = function (options = {}) {
        if (elem) {
            elem.remove();
        }
        // 获取参数
        let {
            content = '兄弟，你好像忘记传content值了', time = 3000
        } = options;


        // 最终生成的HTML
        let html = '<div class="toast-wrapper">' +
            '        <div class="toast">' +
            '         <div class="content">' + content + '</div>' +
            '        </div>' +
            '      </div>';

        // 添加到Body
        $('body').append(html);
        // 获取所需要的节点
        getNeedElement();
        setTimeout(function () {
            hide();
        }, time);
        return elem;
    };

    let hide = function (index) {
        // 最终移除
        setTimeout(() => {
            elem.remove();
        }, 200);

    };

    // 对外暴露的方法
    return {
        show
    }

})();
$(function () {
    var $html = $('html');
    var $win = $(window);
    $html.css('font-size', $win.width());
    $win.on('ready load resize', function () {
        $html.css('font-size', $win.width());
    });
});
//验证手机号码
function phoneReg(tel) {
    var reg = /^1[3456789]{1}[0-9]{9}$/;
    if (tel.length < 1) {
        utils_toast.show({
            content: '手机号不能为空'
        })
        return false;
    }
    if (!reg.test(tel)) {
        utils_toast.show({
            content: '手机号格式错误'
        })
        return false;
    } else {
        return true;
    }
}

function ShowCountDown(start_time, divname) {
    var now = new Date();
    var cc = document.getElementById(divname);
    var endDate = new Date(start_time * 1000);
    var leftTime = endDate.getTime() - now.getTime();
    if (leftTime > 0) {
        var dd = parseInt(leftTime / 1000 / 60 / 60 / 24, 10); //计算剩余的天数
        var hh = parseInt(leftTime / 1000 / 60 / 60 % 24, 10); //计算剩余的小时数
        var mm = parseInt(leftTime / 1000 / 60 % 60, 10); //计算剩余的分钟数
        var ss = parseInt(leftTime / 1000 % 60, 10); //计算剩余的秒数
        dd = checkTime(dd);
        hh = checkTime(hh);
        mm = checkTime(mm);
        ss = checkTime(ss); //小于10的话加0
        if (dd > 0) {
            cc.innerHTML = dd + '天 ' + hh + '时:' + mm + '分:' + ss + '秒';
        } else {
            cc.innerHTML = hh + '时:' + mm + '分:' + ss + '秒';
        }
    } else {
        $('.info_main').removeClass('show');
        $('.sub_info').addClass('show')
    }
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
