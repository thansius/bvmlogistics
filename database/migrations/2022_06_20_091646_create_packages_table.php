<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('packageID');
            $table->text('trackingNumber');
            $table->double('length');
            $table->double('width');
            $table->double('height');
            $table->double('weight');
            $table->string('senderID');
            $table->string('receiverID');
            $table->bigInteger('carrierID');
            $table->smallInteger('status');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE packages AUTO_INCREMENT = 10001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
