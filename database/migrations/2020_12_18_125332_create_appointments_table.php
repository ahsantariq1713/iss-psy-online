<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('therapist_id');
            $table->unsignedBigInteger('client_id');

            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            $table->decimal('amount');
            $table->decimal('platform_fee');
            $table->string('payment_session_id');

            $table->string('client_access_token')->nullable();
            $table->string('therapist_access_token')->nullable();

            $table->timestamp('therapist_attended_at')->nullable();
            $table->timestamp('client_attended_at')->nullable();

            $table->string('opentok_session_id')->nullable();
            $table->text('opentok_token')->nullable();

            $table->text('recommendations')->nullable();
            $table->text('notes')->nullable();

            $table->string('status')->default('Pending');

            $table->text('feedback')->nullable();
            $table->smallInteger('stars')->nullable();

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
        Schema::dropIfExists('appointments');
    }
}
