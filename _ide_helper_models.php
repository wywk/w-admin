<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Model{
/**
 * App\Model\Admin
 *
 * @property int $id
 * @property string $name
 * @property string $email 邮箱
 * @property int $status 是否启用
 * @property int $role_id 所属角色
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property-read \App\Model\Role|null $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin search($where)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Admin withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Admin withoutTrashed()
 */
	class Admin extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\File
 *
 * @property int $id
 * @property string $origin_name 原文件名
 * @property string $path 附件地址
 * @property int $size 文件大小
 * @property int $admin_id 管理员id
 * @property string $ext 文件后缀
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property mixed|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $img_path
 * @property-read mixed $size_show
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\File onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File search($where)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File whereExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File whereOriginName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\File withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\File withoutTrashed()
 */
	class File extends \Eloquent {}
}

namespace App\Model{
/**
 * Class Log
 *
 * @property-read Admin $admin
 * @package App\Model
 * @property int $id
 * @property int $admin_id 操作人
 * @property string $url 操作url
 * @property string $name 操作
 * @property string $method 请求方式
 * @property string $request 请求信息
 * @property string $ip IP地址
 * @property mixed|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $admin_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log search($where)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log whereRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Log whereUrl($value)
 */
	class Log extends \Eloquent {}
}

namespace App\Model{
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
	class Menu extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\RoleModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Role query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $role_name
 * @property string $remark
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Role whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Role whereRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Model{
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
	class RoleMenu extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 * @property-read int|null $notifications_count
 */
	class User extends \Eloquent {}
}

