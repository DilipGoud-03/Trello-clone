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
        Schema::create('ticket__attachments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tickets_id')->unsigned()->index()->nullable();
            $table->bigInteger('comment_id')->unsigned()->index()->nullable();
            $table->string('name');
            $table->string('path');
            $table->string('type');
            $table->timestamps();

            $table->foreign('tickets_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket__attachments');
    }
};
