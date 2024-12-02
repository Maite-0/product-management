<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);  
            $table->integer('stock')->default(0);  // Stock quantity
            $table->string('image_url')->nullable();
            $table->string('category')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('owner_mobilenumber')->nullable();
            $table->string('sku')->unique();
            $table->string('status')->default('active');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();  
            $table->foreignId('updated_by')->nullable()->constrained('users'); 
            $table->timestamps();
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
