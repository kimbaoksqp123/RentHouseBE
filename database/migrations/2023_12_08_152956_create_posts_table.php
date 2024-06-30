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
            $table->string('street')->nullable();
            $table->string('ward',50);
            $table->string('district',50);
            $table->integer('price');
            $table->integer('land_area');
            $table->tinyInteger('type');
            $table->integer('view_number');
            $table->text('description');
            $table->tinyInteger('bedroom_num');
            $table->tinyInteger('bathroom_num');
            $table->double('latitude');
            $table->double('longitude');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes(); // Thêm trường deleted_at

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                
            $table->index('user_id');
            $table->index(['district', 'ward', 'price','land_area']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['district', 'ward', 'price', 'land_area']);
        });
        Schema::dropIfExists('posts');
    }
};
