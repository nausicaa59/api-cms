<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model 
{

    protected $table = 'articles';
    public $timestamps = true;

    public function categorie()
    {
        return $this->belongsTo('App\Categorie','categorie');
    }

    public function auteur()
    {
        return $this->hasOne('Auteur', 'auteur');
    }

}