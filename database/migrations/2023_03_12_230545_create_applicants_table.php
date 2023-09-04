<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lottery_id')->unsigned()->nullable() ;
            $table->foreign('lottery_id')->references('id')->on('lotteries')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->boolean('is_winner')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
