<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('meta_title', 130);
			$table->text('meta_description');
			$table->string('title', 130);
			$table->string('slug');
			$table->text('description');
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}