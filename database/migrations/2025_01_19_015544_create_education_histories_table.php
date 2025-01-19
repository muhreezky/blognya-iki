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
        Schema::create('education_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class);
            $table->string('institution');
            $table->string('major');
            $table->string('degree');
            $table->string('description', 400);
            $table->integer('start_month');
            $table->integer('start_year');
            $table->integer('end_month');
            $table->integer('end_year');
            $table->timestamps();

            $table->index('user_id');
            $table->index(['start_month', 'start_year']);
            $table->index(['end_month', 'end_year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_histories');
    }
};
