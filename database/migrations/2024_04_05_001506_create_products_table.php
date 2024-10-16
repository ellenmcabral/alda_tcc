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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->text('description')->nullable();
            $table->binary('image');
            $table->string('url')->nullable();
            $table->decimal('cost_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2);
            $table->unsignedInteger('stock')->nullable();
            $table->unsignedInteger('deadline')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->boolean('is_active')->default(true);

            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
