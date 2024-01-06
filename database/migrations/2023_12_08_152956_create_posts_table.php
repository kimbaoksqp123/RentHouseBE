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
        Schema::create('posts', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('address');
            $table->string('street');
            $table->string('ward');
            $table->string('district');
            $table->integer('price');
            $table->integer('land_area');
            $table->integer('type');
            $table->integer('view_number');
            $table->text('description');
            $table->integer('bedroom_num');
            $table->integer('bathroom_num');
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
