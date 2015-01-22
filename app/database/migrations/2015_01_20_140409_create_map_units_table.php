<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('map_units', function($t) {
                $t->bigInteger('id')->unsigned();
                $t->string('name');
                $t->string('latitude', 20);
                $t->string('longitude', 20);
                
                $t->primary('id');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::dropIfExists('map_units');
	}

}
