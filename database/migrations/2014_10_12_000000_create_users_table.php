<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('full_name')->nullable();
            $table->string('email');
            $table->integer('level')->default(1);
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('user_token')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('gentle')->nullable();
            $table->double('salary_total')->default(0);
            $table->string('image')->nullable();
            $table->string('role')->nullable();
            $table->double('work_total')->default(0);
            $table->double('salary_per_hour')->default(0);
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
