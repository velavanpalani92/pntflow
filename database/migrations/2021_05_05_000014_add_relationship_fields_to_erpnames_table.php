<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToErpnamesTable extends Migration
{
    public function up()
    {
        Schema::table('erpnames', function (Blueprint $table) {
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->foreign('zone_id', 'zone_fk_3837852')->references('id')->on('zones');
        });
    }
}
