<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('label');
            $table->string('color');

        });
        DB::table('statuses')->insert([
            'label' => 'sent',
            'color' => 'yellow'
        ]);
        DB::table('statuses')->insert([
            'label' => 'interview_date',
            'color' => 'light-blue'
        ]);
        DB::table('statuses')->insert([
            'label' => 'pending_after_interview',
            'color' => 'sapphire'
        ]);
        DB::table('statuses')->insert([
            'label' => 'accepted',
            'color' => 'green'
        ]);
        DB::table('statuses')->insert([
            'label' => 'declined',
            'color' => 'red'
        ]);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
