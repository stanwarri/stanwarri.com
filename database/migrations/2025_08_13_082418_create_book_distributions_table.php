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
        Schema::create('book_distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->string('qr_code')->unique();
            $table->date('distribution_date')->nullable();
            $table->string('distribution_location')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'distributed', 'registered'])->default('pending');
            $table->timestamps();

            $table->index('qr_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_distributions');
    }
};
