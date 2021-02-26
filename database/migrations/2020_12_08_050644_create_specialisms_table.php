<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialisms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('specialism_category_id')->nullable();
            $table->timestamps();
        });

        Schema::create('specialism_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specialism_id');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('specialisms');
    }
}
