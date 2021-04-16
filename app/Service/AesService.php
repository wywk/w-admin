<?php

namespace App\Service;

class AesService
{
    /**
     * 可逆解密
     * @param $data
     * @param $key
     * @return mixed
     * @author wywk  947036348@qq.com
     * @date   2020/1/9 11:59
     */
    static public function decrypt($data, $key)
    {
        return json_decode(openssl_decrypt(base64_decode($data), 'aes-128-ecb', $key), true);
    }

    /**
     * 可逆加密
     * @param $data
     * @param $key
     * @return string
     * @author wywk  947036348@qq.com
     * @date   2020/1/9 12:00
     */
    static public function encrypt($data, $key)
    {
        $data = json_encode($data);
        return base64_encode(openssl_encrypt($data, 'aes-128-ecb', $key));
    }

    /**
     * 生成sign签名
     * @param array $data 要签名的数据
     * @param string $key
     * @return string
     * @author wywk  947036348@qq.com
     * @date   2019/11/6 16:47
     */
    static public function sign_encrypt($data, $key)
    {
        unset($data['sign']);
        $data = array_filter($data, 'strlen');
        ksort($data);
        $secret = urldecode(http_build_query($data));
        $secret .= "&key={$key}";
        return strtoupper(md5($secret));
    }

    /**
     * 验证签名
     * @param array $data 要验证的原始数组数据
     * @param string $sign 签名数据
     * @param string $key key
     * @return bool
     * @author wywk  947036348@qq.com
     * @date   2019/11/6 16:47
     */
    static public function sign_decrypt($data, $sign, $key)
    {
        return $sign == self::sign_encrypt($data, $key);
    }
}
