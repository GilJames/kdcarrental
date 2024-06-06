<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmincarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admincars', function (Blueprint $table) {
            $table->id();
            $table->string('carname');
            $table->string('carprice');
            $table->string('carmodel');
            $table->string('carseats');
            $table->string('carhistory');
            $table->string('fueltype');
            $table->string('cartype');
            $table->string('image');
            $table->string('status')->nullable()->default('available');
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
        Schema::dropIfExists('admincars');
    }
}
