<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('meta_title', 100);
			$table->string('meta_description', 130);
			$table->string('title', 130);
			$table->string('slug', 130);
			$table->text('description');
			$table->string('img_catego', 130);
			$table->string('fa_image', 130);
			$table->string('fa_title', 130);
			$table->text('fa_description');
			$table->integer('categorie')->unsigned();
			$table->integer('auteur')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}