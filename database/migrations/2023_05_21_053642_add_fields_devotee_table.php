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
        Schema::table('devotee', function (Blueprint $table) {
            $table->string('email')->nullable()->after('last_name');
            $table->string('mobile_no_2')->nullable()->after('mobile_no');
            $table->tinyInteger('marital_status')->nullable()->comment('1=single, 2=married')->after('city_id');
            $table->date('marriage_date')->nullable()->after('marital_status');
            $table->string('native_place')->nullable()->after('marriage_date');
            $table->string('aadhar_card')->nullable()->after('native_place');
            $table->string('pan_card')->nullable()->after('aadhar_card');
            $table->string('passport')->nullable()->after('pan_card');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devotee', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('mobile_no_2');
            $table->dropColumn('marital_status');
            $table->dropColumn('marriage_date');
            $table->dropColumn('native_place');
            $table->dropColumn('aadhar_card');
            $table->dropColumn('pan_card');
            $table->dropColumn('passport');
        });
    }
};
