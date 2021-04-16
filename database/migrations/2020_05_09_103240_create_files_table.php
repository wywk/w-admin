<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('origin_name')->comment('原文件名');
            $table->string('path')->comment('附件地址');
            $table->unsignedBigInteger('size')->comment('文件大小');
            $table->integer('admin_id')->comment('管理员id');
            $table->string('ext', 10)->comment("文件后缀");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
