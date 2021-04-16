<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Menu
 *
 * @property int $id
 * @property string $menu_name 菜单名
 * @property int $sort 排序
 * @property string $url 链接地址
 * @property string $icon 图标类名
 * @property string $remark 说明
 * @property int $pid 上级菜单
 * @property int $is_show 是否渲染链接，1渲染0不渲染
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Menu[] $children
 * @property-read int|null $children_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu whereMenuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Menu whereUrl($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    protected $guarded = [];
    public function children(){
        return $this->hasMany($this,'pid')->orderBy('sort','asc');
    }
}
