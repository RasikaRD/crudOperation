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
        Schema::create('todolists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('todo_id');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('contents');
            $table->integer('status')->default(0);
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();

            $table->foreign('todo_id')->references('id')->on('todos')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todolists');
    }
};
