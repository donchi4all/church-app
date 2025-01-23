<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('upcoming_sermons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('pastor');
            $table->string('image');
            $table->date('date');
            $table->string('button_text');
            $table->string('button_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upcoming_sermons');
    }
};
