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
        Schema::create('request_view_houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('house_id');
            $table->timestamp('view_time');
            $table->tinyInteger('status'); // 1:pending 2:approved 3:rejected 4:deleted
            $table->string('tenant_message')->nullable(); // người thuê
            $table->string('rent_message')->nullable(); // người cho thuê
            $table->unsignedBigInteger('deleted_by')->nullable(); // id người xóa;
            $table->timestamps();
            $table->softDeletes(); // Thêm trường deleted_at

            $table->index('user_id');

            $table->foreign('user_id')
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
        Schema::table('request_view_houses', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
        });
        Schema::dropIfExists('request_view_houses');
    }
};
