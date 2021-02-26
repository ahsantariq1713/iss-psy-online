<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practice_licenses', function (Blueprint $table) {
            $table->id();
            $table->text('video_url')->nullable();
            $table->text('about')->nullable();
            $table->string('academic_title');
            $table->string('experience');
            $table->string('type');
            $table->string('reference');
            $table->string('license_doc');
            $table->string('support_doc')->nullable();
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
        Schema::dropIfExists('practice_licenses');
    }
}
