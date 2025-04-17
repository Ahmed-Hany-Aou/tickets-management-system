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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_link')->nullable(false);  // NOT NULL
            $table->string('category')->nullable(false);     // NOT NULL
            $table->string('status')->nullable(false);       // NOT NULL
            $table->string('ticket_date')->nullable(false);  // NOT NULL
            $table->string('agent')->nullable(false);        // NOT NULL
            $table->string('solved_by')->nullable(false);    // NOT NULL
            $table->string('last_reminder')->nullable();     // NULL
            $table->text('comments')->nullable();            // NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
