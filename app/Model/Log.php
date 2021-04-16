<?php

namespace App\Model;

use App\Model\Traits\Search;
use App\Model\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Log
 * @property-read Admin $admin
 * @package App\Model
 */
class Log extends Model
{
    use Timestamp, Search;

    protected $guarded = [];
    protected $casts = ['created_at' => 'datetime:Y-m-d H:i:s'];
    protected $appends = ['admin_name'];
    protected $hidden = ['admin'];
    protected $searchEqual = ['method'];
    protected $searchLike = ['url', 'request', 'ip'];
    protected $searchTime = ['created_at'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function setRequestAttribute($value)
    {
        $this->attributes['request'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getAdminNameAttribute($value)
    {
        return $this->admin->name;
    }
}
