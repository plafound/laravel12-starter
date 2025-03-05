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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon'); // icon
            $table->string('url')->nullable()->unique(); // Route menu
            $table->string('permission')->unique(); // Nama permission untuk menu ini
            $table->unsignedBigInteger('parent_id')->nullable(); // Jika menu ini submenu
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
            $table->integer('order')->nullable(); // Urutan menu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
