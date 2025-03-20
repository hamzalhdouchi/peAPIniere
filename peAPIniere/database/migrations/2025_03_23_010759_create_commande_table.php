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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('plante_id')->constrained('plantes')->onDelete('cascade'); 
            $table->integer('quantity'); 
            $table->enum('acciptaion',['accepte','refsuer'])->default('refuser');
            $table->enum('statut', ['pending', 'in_preparation', 'delivered'])->default('pending'); 
            $table->timestamps(); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande');
    }
};
