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
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('name');
            $table->foreignIdFor(Places::class)->constrained()->onDelete('cascade');
            $table->string('phone');
            $table->string('country_code_phone');
            $table->string('space_of_estate');
            $table->string('price_of_meter');
            $table->string('rent_kind')->nullable();
            $table->string('is_furnished_text');
            $table->string('floor');
            $table->string('num_of_bedrooms');
            $table->string('num_of_livingrooms');
            $table->string('num_of_receptions');
            $table->string('num_of_bathrooms');
            $table->string('num_of_kitchens');
            $table->string('num_of_balconies');
            $table->string('status')->default('pending');
            $table->string('type_text');
            $table->foreignIdFor(Social_media::class)->constrained()->onDelete('cascade');
            $table->string('kind_text');
            $table->string('description');
            $table->string('price');
            $table->string('real_number');
            $table->string('date_of_build');
            $table->string('state_of_build');
            $table->string('rent_description')->nullable();
            $table->integer('views')->default(0);
            $table->integer('shares')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};
