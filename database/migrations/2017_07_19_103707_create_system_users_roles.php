<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemUsersRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_users_roles', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('uid', false, true)->comment('用户UID');
            $table->integer('rid', false, true)->comment('角色ID');
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
        Schema::dropIfExists('system_users_roles');
    }
}
