<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('ID người dùng');
            $table->string('name')->comment('Tên đầy đủ người dùng');
            $table->string('email')->unique()->comment('Email đăng ký');
            $table->string('password')->comment('Mật khẩu tài khoản');
            $table->string('username')->unique()->comment('Tên đăng nhập');
            $table->date('birthday')->comment('Ngày sinh');
            $table->integer('gender')->comment('Giới tính: 1 - Nam, 2 - Nữ');
            $table->string('address')->nullable()->comment('Địa chỉ nhận hàng');
            $table->string('phone_number')->comment('Số điện thoại');
            $table->integer('permission')->default(0)->comment('Quyền: 0 - Khách hàng, 1 - Admin');
            $table->integer('status')->default('1')->comment('Trạng thái tài khoản: 0 - Bị khóa, 1 - Đang hoạt động');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
