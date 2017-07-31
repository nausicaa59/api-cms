<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestModel extends Model 
{
    public static function getAll($context)
    {
		$obj = self::query();
		$obj = self::addFields($obj, $context);	
		$obj = self::addOrder($obj, $context);	
		$obj = self::addLimit($obj, $context);
    	return $obj->get();
    }


    public static function getSpecificFields($id, $context)
    {
        $obj = self::query();
        $obj = self::addFields($obj, $context);
        return $obj->find($id);
    }


    public static function addLimit($query, $context)
    {
    	$range = $context["range"]["val"];
    	if(empty($range))
    	{
    		return $query;
    	}

    	$limit = $range[1] - $range[0];
    	$offset = $range[0]; 

    	return $query->offset($offset)->limit($limit);
    }


    public static function addFields($query, $context)
    {
    	$fields = $context["fields"]["val"];
    	if(empty($fields))
    	{
    		return $query;
    	}

    	return $query->select($fields);
    }


    public static function addOrder($query, $context)
    {
    	$sort = $context["sort"]["val"];
    	$desc = $context["desc"]["val"];

    	if(empty($sort))
    	{
    		return $query;
    	}

    	foreach ($sort as $champs)
    	{
    		$sens = (in_array($champs, $desc)) ? "DESC" : "ASC";    		
    		$query = $query->orderBy($champs, $sens);
    	}

    	return $query;
    }
}