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
        Schema::create('navigation_page', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('navigation_id');
            $table->unsignedBigInteger('page_id');
            $table->timestamps();

            $table->foreign('navigation_id')->references('id')->on('navigations')->onDelete('cascade');
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation_page');
    }
};
