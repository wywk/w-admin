<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('admin_id')->comment('操作人');
            $table->string('url')->comment('操作url');
            $table->string('name')->comment('操作');
            $table->string('method')->comment('请求方式');
            $table->text('request')->comment('请求信息');
            $table->ipAddress('ip')->comment('IP地址');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
