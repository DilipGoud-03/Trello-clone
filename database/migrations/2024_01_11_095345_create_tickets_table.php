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
            $table->bigInteger('stage_id')->unsigned()->index()->nullable();
            $table->bigInteger('assignee')->unsigned()->index()->nullable();
            $table->string('name');
            $table->longText('description');
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
            $table->foreign('assignee')->references('id')->on('user__invites')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('user__invites')->onDelete('cascade');
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
