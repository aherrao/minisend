<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 16);
            $table->string('icon', 64)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->integer('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_types');
    }
}
