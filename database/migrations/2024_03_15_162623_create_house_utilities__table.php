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
        Schema::create('house_utilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('house_id');
            $table->unsignedBigInteger('utility_id');
            $table->string('image')->nullable();
            $table->integer('price')->nullable();
            $table->tinyInteger('quantity')->nullable();
            $table->timestamps();

            $table->index('house_id');

            $table->foreign('house_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('utility_id')
                ->references('id')
                ->on('utilities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('house_utilities', function (Blueprint $table) {
            $table->dropIndex(['house_id']);
        });
        Schema::dropIfExists('house_utilities');
    }
};
