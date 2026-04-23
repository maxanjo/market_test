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
            $table->string('name');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->unsignedDecimal('price', 10, 2)->index();
            $table->boolean('in_stock')->default(true);
            $table->unsignedDecimal('rating', 2, 1)->default(0)->index();
            $table->timestamps();
            $table->fullText('name');
            $table->index('created_at');

            $table->index(['category_id', 'price']);
            $table->index(['category_id', 'in_stock']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
