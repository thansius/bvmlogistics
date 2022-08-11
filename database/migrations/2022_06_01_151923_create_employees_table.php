<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('employeeID')->startingValue(20220001);
            $table->string('lastName');
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->date('birthday');
            $table->string('position');
            $table->string('department');
            $table->string('contactNumber')->nullable();
            $table->timestamps();
        });

        // DB::update("ALTER TABLE employees AUTO_INCREMENT = 20220001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
