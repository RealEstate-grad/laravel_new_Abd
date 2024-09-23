<?php

use App\Models\Companies;
use App\Models\Social_media;
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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Companies::class)->constrained()->onDelete('cascade');
            $table->string('profile_image')->nullable();
            $table->integer('views')->default(0);
            $table->integer('shares')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
