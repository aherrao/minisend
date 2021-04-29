<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->nullable()->index();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('email_status_type_id')->nullable()->index();
            $table->foreign('email_status_type_id')->references('id')->on('email_status_types');
            $table->string('subject')->nullable();
            $table->string('from_email');
            $table->string('to_email');
            $table->text('body');
            $table->json('extra_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
