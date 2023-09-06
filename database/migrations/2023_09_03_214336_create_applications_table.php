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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('company_name');
            $table->string('url');
            $table->string('position_name');
            $table->integer('expected_salary');
            $table->date('application_sent');
            $table->date('first_reply');
            $table->date('interview_date');
            $table->text('notes');
            $table->foreignId('status_id')->constrained('statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
