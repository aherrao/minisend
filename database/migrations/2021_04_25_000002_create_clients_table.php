<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 64)->unique();
            $table->string('sub_domain', 16)->unique();
            $table->string('secret_key', 64)->unique()->index();
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            $table->date('trial_ends_at')->nullable();
            $table->json('extra_data')->nullable();
            $table->unsignedBigInteger('client_type_id');
            $table->foreign('client_type_id')->references('id')->on('client_types');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamp('created_at')->default(DB::raw('now()'));
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamp('updated_at')->default(DB::raw('now()'));
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
