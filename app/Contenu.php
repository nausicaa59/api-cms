<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenu extends Model 
{

    protected $table = 'contenu';
    public $timestamps = true;

    public function article()
    {
        return $this->hasOne('Article', 'article');
    }

}