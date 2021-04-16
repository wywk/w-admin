<?php

namespace App\Model;

use App\Model\Traits\Search;
use App\Model\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use Timestamp, Search, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['img_path', 'size_show'];
    protected $casts = ['created_at' => 'datetime:Y-m-d H:i:s'];
    protected $searchTime = ['created_at'];
    protected $searchLike = ['origin_name'];

    public function getImgPathAttribute()
    {
        return $this->ext == 'pdf' ? $this->path . '.png' : $this->path;
    }

    public function getSizeShowAttribute()
    {
        return getFilesize($this->size);
    }
}
