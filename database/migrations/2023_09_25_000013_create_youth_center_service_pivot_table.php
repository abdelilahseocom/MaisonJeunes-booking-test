<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYouthCenterServicePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youth_center_service', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('youth_center_id');
            $table->foreign('youth_center_id')->references('id')->on('youth_centers')->onDelete('cascade');
            $table->unsignedInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->integer('duration');
            $table->integer('max_places')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('youth_center_service');
    }
}
