<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelfdrivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selfdrives', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('admincars_id');
            $table->string('carname');
            $table->string('carprice');
            $table->string('carmodel');
            $table->string('carseats');

            $table->string('pickuptime');
            $table->string('pickupdate');
            $table->string('dropofftime');
            $table->string('dropoffdate');
            $table->string('destination');
            $table->string('daytrip')->nullable();
            $table->string('license');
            $table->string('status')->nullable()->default('pending');
            $table->string('reject_reason')->nullable();
            $table->string('cancelled_reason')->nullable();
            $table->bigInteger('confirmed_OR')->nullable();
            $table->integer('total_payment')->nullable();
            $table->date('lastrate')->nullable();
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
        Schema::dropIfExists('selfdrives');
    }
}
