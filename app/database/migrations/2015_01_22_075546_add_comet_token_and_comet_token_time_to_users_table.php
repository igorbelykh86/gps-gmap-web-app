<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCometTokenAndCometTokenTimeToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('users', function($t) {
                $t->string('comet_token');
                $t->timestamp('comet_token_created_at');
                $t->unique(array('id', 'comet_token'));
                $t->index('comet_token');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('users', function($t) {
                $t->dropIndex('comet_token');
                $t->dropUnique(array('id', 'comet_token'));
                $t->dropColumn('comet_token');
                $t->dropColumn('comet_token_created_at');
            });
	}

}
