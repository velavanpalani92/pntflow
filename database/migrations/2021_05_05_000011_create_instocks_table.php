<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstocksTable extends Migration
{
    public function up()
    {
        Schema::create('instocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serialno')->nullable();
            $table->string('source')->nullable();
            $table->string('orderno')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
