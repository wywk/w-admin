<?php

namespace App\Model;

use App\Model\Traits\Search;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use SoftDeletes, Search;

    protected $guarded = [];
    protected $searchLike = ['true_name'];
    protected $searchEqual = ['name'];

    /**
     * 获取角色名
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:11
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
