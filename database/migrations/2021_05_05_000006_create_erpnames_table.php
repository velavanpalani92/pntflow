<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErpnamesTable extends Migration
{
    public function up()
    {
        Schema::create('erpnames', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('erpname')->nullable();
            $table->string('code')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
