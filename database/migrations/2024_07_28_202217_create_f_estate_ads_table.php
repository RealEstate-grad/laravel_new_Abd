<?php

use App\Models\Estate;
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
        Schema::create('f_estate_ads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Estate::class)->constrained()->onDelete('cascade');
            $table->string('ads');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('f_estate_ads');
    }
};
