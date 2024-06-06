<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('admincars_id')->nullable();
            $table->string('comment', 100)->nullable();
            $table->integer('rating')->nullable();
            $table->string('booking_model')->nullable();
            $table->string('status', 50)->nullable()->default('rated');
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
        Schema::dropIfExists('feedback');
    }
}
