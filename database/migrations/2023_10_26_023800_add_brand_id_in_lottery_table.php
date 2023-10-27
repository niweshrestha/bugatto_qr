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
        Schema::table('lotteries', function (Blueprint $table) {
            $table->bigInteger('brand_id')->nullable()->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lotteries', function (Blueprint $table) {
            $table->dropForeign('lotteries_brand_id_foreign');
            $table->dropColumn('brand_id');
        });
    }
};
