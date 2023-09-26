<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    use SoftDeletes;

    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->text('comment')->nullable();
            $table->string('type')->nullable();
            $table->unsignedInteger('client_id')->nullable();            
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedInteger('youth_center_service_id')->nullable();
            $table->foreign('youth_center_service_id')->references('id')->on('youth_center_service')->onDelete('cascade');
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
        Schema::dropIfExists('bookings');
    }
}
