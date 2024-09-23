<?php

use App\Models\Places;
use App\Models\Social_media;
use App\Models\User;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Places::class)->constrained()->onDelete('cascade');
            $table->string('company_name');
            $table->string('website')->nullable();
            $table->string('emploies_num');
            $table->string('description');
            $table->string('work_days');
            $table->string('profile_images')->nullable();
            $table->string('banner_image')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
