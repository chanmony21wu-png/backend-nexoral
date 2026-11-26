<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('cat', 50);
            $table->enum('section', ['shop', 'collection'])->default('shop');
            $table->decimal('price', 10, 2);
            $table->string('note', 255)->default('');
            $table->text('description')->nullable();
            $table->json('specs')->nullable();
            $table->string('img', 255)->default('');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
