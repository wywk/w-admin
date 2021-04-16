<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="email=no"/>
    <meta name="format-detection" content="address=no;">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name=”apple-mobile-web-app-status-bar-style” content=black”/>
    <meta content="telephone=no" name="format-detection"/>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>领取优惠券</title>
    <link rel="stylesheet" type="text/css" href="{{asset('h5/css/style.css')}}"/>
</head>
<body>
<div class="content_wrapper">
    <div class="coupon_bg">
        <div class="coupon_main">
            <div class="coupon_info">
                <div class="left_info">
                    <div class="coupon_num">
                        <span class="unit">￥</span><span id="amount"></span>
                    </div>
                    <div class="coupon_tip" id="threshold"></div>
                </div>
                <div class="right_info">
                    <div class="coupon_name" id="name"></div>
                    <div class="coupon_time" id="use_coupons_mode"></div>
                </div>
            </div>
            <div class="sub_info info_main  show">
                <input type="number" pattern="[0-9]*" class="sub_tel" value="" placeholder="请输入手机号" id="phone"/>
                <div class="sub_btn">立即领取</div>
            </div>
            <div class="success_info info_main">
                <img src="{{asset('h5/img/success_ico.png')}}" class="success_ico">
                <div class="success_text">领取成功</div>
            </div>
            <div class="error_info info_main">
                <div class="confirm_btn">您来晚了，已被领取完</div>
            </div>
            <div class="time_info info_main">
                <div class="count_btn"><span id="time_box">00时:00分:00秒</span> 后开始</div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('h5/js/jquery-1.11.1.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('h5/js/base.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('h5/js/input_focus.js')}}"></script>
<script>
    var uv = localStorage.getItem('uv');
    if (!uv) {
        uv = randomString(32);
        localStorage.setItem('uv', uv)
    }
    $.post('{{asset('api/web/coupon/find')}}', {key: "{{request()->input('key')}}",uv:uv}, function (res) {
        console.log(res);
        if (res.code === 0) {
            $("#amount").html(res.data.amount + 0);
            $("#threshold").html(res.data.threshold);
            $("#name").html(res.data.name);
            $("#use_coupons_mode").html(res.data.use_coupons_mode);
            if (res.data.status === 2) {
                $('.sub_info').removeClass('show');
                $('.error_info').addClass('show');
            } else if (res.data.status === 3) {
                $('.sub_info').removeClass('show');
                setInterval(function () {
                    ShowCountDown(res.data.start_time, 'time_box');
                }, 1000);
                $('.time_info').addClass('show');
            }
        } else {
            utils_toast.show({
                content: res.msg
            })
        }
    })
    $('.sub_btn').click(function () {
        var key = "{{request()->input('key')}}";
        var phone = $('#phone').val();
        var phoneStatus = phoneReg(phone);
        if (!phoneStatus) {
            return false
        }
        $.post('{{asset('api/web/coupon/draw')}}', {key: key, phone: phone}, function (res) {
            if (res.code === 0) {
                $('.sub_info').removeClass('show');
                $('.success_info').addClass('show');
            } else {
                utils_toast.show({
                    content: res.msg
                })
                location.reload();
            }
        })

    });

    function randomString(len) {
        len = len || 32;
        var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
        var maxPos = $chars.length;
        var pwd = '';
        for (i = 0; i < len; i++) {
            pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
        }
        return pwd;
    }

</script>
</body>
</html>
