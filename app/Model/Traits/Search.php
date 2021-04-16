<?php

namespace App\Model\Traits;

use Illuminate\Database\Query\Builder;

/**
 * Trait Search
 * @method Builder|\Illuminate\Database\Eloquent\Builder search(array $where) //查询条件
 * @property-write array $searchTime
 * @property-write array $searchLike
 * @property-write array $searchEqual
 * @package App\Model\Traits
 */
trait Search
{
    /**
     * 查询作用域
     * @param $query
     * @param $where
     * @return mixed
     * @author wywk  947036348@qq.com
     * @date 2020/5/11 16:05
     */
    public function scopeSearch($query, $where)
    {
        if (property_exists($this, 'searchTime')) {
            foreach ($this->searchTime as $v) {
                if (isset($where[$v])) {
                    [$start, $end] = explode(' - ', $where[$v]);
                    if ($start && $end) {
                        $query->where($v, '>=', $start)->where($v, '<=', $end);
                    }
                }
            }
        }
        if (property_exists($this, 'searchLike')) {
            foreach ($this->searchLike as $v) {
                if (isset($where[$v])) {
                    $query->where($v, 'like', "%{$where[$v]}%");
                }
            }
        }
        if (property_exists($this, 'searchIn')) {
            foreach ($this->searchIn as $v) {
                if (isset($where[$v])) {
                    if(!is_array($where[$v])){
                        $where[$v] = explode(',',$where[$v]);
                    }
                    $query->whereIn($v,$where[$v]);
                }
            }
        }
        if (property_exists($this, 'searchEqual')) {
            foreach ($this->searchEqual as $v) {
                if (isset($where[$v])) {
                    $query->where($v, $where[$v]);
                }
            }
        }

        if (property_exists($this, 'searchGreater')) {
            foreach ($this->searchGreater as $v) {
                if (isset($where[$v])) {
                    $query->where($v, '>', $where[$v]);
                }
            }
        }

        if (property_exists($this, 'searchBetween')) {
            foreach ($this->searchBetween as $v) {
                if (isset($where[$v . "_min"])) {
                    $query->where($v, '<=', $where[$v . "_min"]);
                }
                if (isset($where[$v . "_max"])) {
                    $query->where($v, '>=', $where[$v . "_max"]);
                }
            }
        }
        return $query;
    }
}
