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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('house_id');
            $table->unsignedBigInteger('tenant_id');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('file')->nullable();
            $table->timestamps();

            $table->index('tenant_id');

            $table->foreign('tenant_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('house_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropIndex(['tenant_id']);
        });
        Schema::dropIfExists('contracts');
    }
};
