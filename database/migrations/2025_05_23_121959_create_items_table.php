<?php

// database/migrations/xxxx_xx_xx_create_items_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('status')->default('lost'); // lost, found, claimed
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            $table->string('contact')->nullable(); // can store email or phone
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
}
