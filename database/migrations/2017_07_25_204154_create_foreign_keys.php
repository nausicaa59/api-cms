<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('articles', function(Blueprint $table) {
			$table->foreign('categorie')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('articles', function(Blueprint $table) {
			$table->foreign('auteur')->references('id')->on('auteurs')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('contenu', function(Blueprint $table) {
			$table->foreign('article')->references('id')->on('articles')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('articles', function(Blueprint $table) {
			$table->dropForeign('articles_categorie_foreign');
		});
		Schema::table('articles', function(Blueprint $table) {
			$table->dropForeign('articles_auteur_foreign');
		});
		Schema::table('contenu', function(Blueprint $table) {
			$table->dropForeign('contenu_article_foreign');
		});
	}
}