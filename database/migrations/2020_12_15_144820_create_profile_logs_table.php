<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_logs', function (Blueprint $table) {
            $table->id();
            $table->boolean('license')->default(false);
            $table->boolean('identity')->default(false);
            $table->boolean('education')->default(false);
            $table->boolean('experience')->default(false);
            $table->boolean('roster')->default(false);
            $table->boolean('sessions')->default(false);
            $table->boolean('pricing')->default(false);
            $table->boolean('payment')->default(false);
            $table->string('status')->default('Pending');
            $table->timestamp('verified_at')->nullable();
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('profile_logs');
    }
}
