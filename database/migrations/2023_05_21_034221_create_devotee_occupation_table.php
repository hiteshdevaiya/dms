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
        Schema::create('devotee_occupation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('devotee_id');
            $table->tinyInteger('type')->default(1)->comment("1=Business, 2=Service, 3=Other");
            $table->tinyInteger('industry_type')->nullable();
            $table->string('title')->nullable();
            $table->longText('address')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->timestamps();

            $table->foreign('devotee_id')->references('id')->on('devotee')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devotee_occupation');
    }
};
