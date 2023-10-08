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
        Schema::create('subscription_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->unique();
            $table->date('agreement_date');
            $table->date('validity_date');
            $table->date('duration')->nullable();
            $table->string('institute_name',100);
            $table->string('authority_name',100);
            $table->text('authority_designation');
            $table->string('authority_mobile',20);
            $table->string('telephone',20)->nullable();
            $table->string('email',100)->unique();
            $table->string('chairman_name',100)->nullable();
            $table->string('chairman_mobile',20)->nullable();
            $table->string('ict_in_charge',100)->nullable();
            $table->string('ict_in_charge_mobile',20)->nullable();
            $table->text('address');
            $table->string('upazila_thana',50);
            $table->string('district',50);
            $table->string('division',50);
            $table->string('institute_type',20);
            $table->string('education_board',20);
            $table->string('module_list',20)->nullable();
            $table->integer('student_quantity');
            $table->integer('hr_number_quantity');
            $table->string('payment_type');
            $table->string('institute_domain',200)->nullable();
            $table->date('data_submission_date')->nullable();
            $table->date('tentative_handover_date')->nullable();
            $table->string('sign_2nd',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_forms');
    }
};
