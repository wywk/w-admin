<?php

if (!function_exists('str_rep_key')) {

    /**
     * 关键字搜索标签替换.
     * @param $str
     * @param string $key
     * @return mixed
     * @author wywk  947036348@qq.com
     * @date 2019-07-23 21:36
     */
    function str_rep_key($str, $key = '')
    {
        if ('' == $key) {
            $key = request()->input('key');
        }

        return str_replace($key, "<span style='color:red'>{$key}</span>", $str);
    }
}

if (!function_exists('curl')) {
    function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        $httpInfo = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT,
            'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);// 此处就是参数的列表,给你加了个?
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception(curl_error($ch));
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }
}

if (!function_exists('getFilesize')) {

    /**
     * 文件大小易读
     * @param $num
     * @return string
     * @author wywk  947036348@qq.com
     * @date 2019/10/19 15:47
     */
    function getFilesize($num)
    {
        $p = 0;
        $format = 'bytes';
        if ($num > 0 && $num < 1024) {
            $p = 0;
            return number_format($num) . ' ' . $format;
        }
        if ($num >= 1024 && $num < pow(1024, 2)) {
            $p = 1;
            $format = 'KB';
        }
        if ($num >= pow(1024, 2) && $num < pow(1024, 3)) {
            $p = 2;
            $format = 'MB';
        }
        if ($num >= pow(1024, 3) && $num < pow(1024, 4)) {
            $p = 3;
            $format = 'GB';
        }
        if ($num >= pow(1024, 4) && $num < pow(1024, 5)) {
            $p = 3;
            $format = 'TB';
        }
        $num /= pow(1024, $p);
        return number_format($num, 2) . ' ' . $format;
    }
}

if (!function_exists('unsetNull')) {

    /**
     * null转空
     * @param $arr
     * @return array|string
     * @author wywk  947036348@qq.com
     * @date 2020/5/13 9:50
     */
    function unsetNull($arr)
    {
        if ($arr !== null) {
            if (is_array($arr)) {
                if (!empty($arr)) {
                    foreach ($arr as $key => $value) {
                        if ($value === null) {
                            $arr[$key] = '';
                        } else {
                            $arr[$key] = unsetNull($value);      //递归再去执行
                        }
                    }
                } else {
                    $arr = '';
                }
            } else {
                if ($arr === null) {
                    $arr = '';
                }         //注意三个等号
            }
        } else {
            $arr = '';
        }
        return $arr;
    }
}

if (!function_exists('strToNum')) {
    /**
     * @param array $arr
     * @return array mixed
     * @author wywk  947036348@qq.com
     * @date 2020/6/6 11:38
     */
    function strToNum($arr)
    {
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                $arr[$k] = strToNum($v);
            } elseif (is_numeric(trim($v))) {
                $arr[$k] = $v + 0;
            }
        }
        return $arr;
    }
}




