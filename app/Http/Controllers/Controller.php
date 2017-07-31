<?php

namespace App\Http\Controllers;

use RestHelpers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
	public function getCollection($options)
	{
        $context = RestHelpers::contextCollection($options['request'], $options['autorizedFields']);
        if(!$context["valide"])
        {
            return $this->invalidateContext($context);           
        }

        $collection = $options['traitement']($context);
        if(empty($collection))
        {
            return response()->json([
                'message' => $options['nofound']
            ], 404);             
        }

        return response()->json([
            "context" => $context,
            "data" => $collection
        ]);		
	}


	public function getSingle($options)
	{
        $context = RestHelpers::contextSingle($options['request'], $options['autorizedFields']);
        if(!$context["valide"])
        {
            return $this->invalidateContext($context);             
        }

		$single = $options['traitement']($context);
        if(empty($single))
        {
            return response()->json([
                'message' => $options['nofound']
            ], 404);             
        }

        return response()->json([
            "context" => $context,
            "data" => $single
        ]);
	}


	protected function invalidateContext($context)
	{
        return response()->json([
            'message' => 'Context non valide :',
            "erreurs" => $context["erreurs"]
        ], 405);  
	}
}
