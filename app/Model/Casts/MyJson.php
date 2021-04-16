<?php

namespace App\Model\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MyJson implements CastsAttributes
{

    /**
     * 读取JSON
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return mixed
     * @author wywk  947036348@qq.com
     * @date 2020/6/10 9:37
     */
    public function get($model, $key, $value, $attributes)
    {
        return json_decode($value, true);
    }

    /**
     * 存JSON
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return array|false|string
     * @author wywk  947036348@qq.com
     * @date 2020/6/10 9:37
     */
    public function set($model, $key, $value, $attributes)
    {
        return json_encode(strToNum($value));
    }
}
