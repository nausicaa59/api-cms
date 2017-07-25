<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuteursTable extends Migration {

	public function up()
	{
		Schema::create('auteurs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('nom', 130);
			$table->string('prenom', 130);
			$table->string('slug', 130);
		});
	}

	public function down()
	{
		Schema::drop('auteurs');
	}
}