<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailStatusTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_status_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 16)->unique();
            $table->string('icon', 64)->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->integer('order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_status_types');
    }
}
