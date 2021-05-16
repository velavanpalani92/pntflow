<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOutwardsTable extends Migration
{
    public function up()
    {
        Schema::table('outwards', function (Blueprint $table) {
            $table->unsignedBigInteger('erp_id')->nullable();
            $table->foreign('erp_id', 'erp_fk_3837786')->references('id')->on('erpnames');
            $table->unsignedBigInteger('serialno_id')->nullable();
            $table->foreign('serialno_id', 'serialno_fk_3837787')->references('id')->on('instocks');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_3837814')->references('id')->on('categories');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_3837815')->references('id')->on('statuses');
        });
    }
}
