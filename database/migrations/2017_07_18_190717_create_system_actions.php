<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_actions', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('actionName', 255)->comment('菜单展示名称');
            $table->string('description', 255)->comment('权限描述');
            $table->string('menuUrl', 255)->comment('菜单展示的url');
            $table->string('icon', 255)->comment('菜单图标font-awesome icon')->default('fa-circle-o');
            $table->string('urls', 1000)->comment('所有url，json形式保存');
            $table->integer('weight', false, true)->default(1000)
                ->comment('显示权重，值越小越靠前');
            $table->integer('parentId', false, true)->default(0)
                ->comment('父级菜单ID，0-一级菜单');
            $table->dateTime('addTime')->comment('创建时间')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updateTime')
                ->comment('修改时间')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedTinyInteger('isDelete', false)->default(0)->comment('是否删除：0-否，1-是');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_actions');
    }
}
