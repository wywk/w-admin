<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\RoleMenu
 *
 * @property int $role_id 角色id
 * @property int $menu_id 菜单id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleMenu whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleMenu whereRoleId($value)
 * @mixin \Eloquent
 */
class RoleMenu extends Model
{
    protected $guarded = [];
}
