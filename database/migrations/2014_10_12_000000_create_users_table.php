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
            $table->id();
            $table->string('avatar')->default('assets/images/users/default.png');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('new_email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('new_phone')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('password_changed_at')->nullable();
            $table->string('role');
            $table->boolean('active')->default(true);
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone');
            $table->boolean('subscribed_newsletter')->default(false);
            $table->string('stripe_acc_id')->nullable();
            $table->string('password_reset_token')->nullable();
            $table->timestamp('prt_valid_till')->nullable();
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
