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
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('role')->default('user');//new column
            $table->text('image')->default('user.png');//new column
            $table->string('email')->unique();
            $table->enum('gender',['female','male']);
            $table->date('tgl_lahir');
            $table->string('password');
            $table->enum('status',['normal','blacklist'])->default('normal');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product');
            $table->text('image');
            $table->string('price');
            $table->string('category');//new column
            $table->enum('status',['open','closed']);
            $table->text('description');
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
        Schema::dropIfExists('products');
    }
}
