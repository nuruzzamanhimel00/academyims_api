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
        Schema::create('partners_infos', function (Blueprint $table) {
            $table->id();
            $table->string('partner_name',100);
            $table->string('partner_type',30)->nullable();
            $table->string('partner_code',30)->nullable()->unique();
            $table->string('mobile',20)->nullable();
            $table->string('email',100)->unique();
            $table->string('upazila_thana',100)->nullable();
            $table->string('district',100)->nullable();
            $table->string('division',100)->nullable();
            $table->string('signature',200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners_infos');
    }
};
