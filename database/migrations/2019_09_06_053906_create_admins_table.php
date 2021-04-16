<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->comment = '主表用户表';
            $table->bigIncrements('id');
            $table->string('name', 20);
            $table->string('email', 100)->default('')->comment('邮箱');
            $table->tinyInteger('status')->default(1)->comment('是否启用');
            $table->tinyInteger('role_id')->comment('所属角色');
            $table->string('password', 300);
            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
