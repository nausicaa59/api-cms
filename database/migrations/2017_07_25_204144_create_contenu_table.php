<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContenuTable extends Migration {

	public function up()
	{
		Schema::create('contenu', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('info');
			$table->integer('article')->unsigned();
			$table->integer('position');
		});
	}

	public function down()
	{
		Schema::drop('contenu');
	}
}