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
        Schema::create('design_proposals', function (Blueprint $table) {
            $table->id();
            $table->string('proposal_code')->unique();
            $table->string('client_name');
            $table->string('email');
            $table->string('phone_country_code');
            $table->string('phone_number');
            $table->string('address_street');
            $table->string('address_street2')->nullable();
            $table->string('address_city');
            $table->string('address_province');
            $table->string('address_postal');
            $table->text('project_description')->nullable();
            $table->enum('status', ['Pending', 'Reviewed', 'Approved', 'Rejected'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_proposals');
    }
};
