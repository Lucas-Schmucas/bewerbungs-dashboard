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
            'color' => 'gray'
        ]);
        DB::table('statuses')->insert([
            'label' => 'preparing for interview',
            'color' => 'warning'
        ]);
        DB::table('statuses')->insert([
            'label' => 'pending after interview',
            'color' => 'info'
        ]);
        DB::table('statuses')->insert([
            'label' => 'accepted',
            'color' => 'success'
        ]);
        DB::table('statuses')->insert([
            'label' => 'declined',
            'color' => 'danger'
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
