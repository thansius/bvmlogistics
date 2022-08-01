<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customers')) {
            Schema::create('customers', function (Blueprint $table) {
              $table->id();
              $table->string('lastName');
              $table->string('firstName');
              $table->string('middleName')->nullable();
              $table->string('contactNumber');
              $table->string('floor_unit');
              $table->string('streetAddress');
              $table->string('province');
              $table->string('city_municipality');
              $table->string('barangay');
              $table->integer('zipCode')->nullable();
              $table->timestamps();
          });
        }
        
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
