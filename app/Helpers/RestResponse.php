<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class RestResponse
{
	public static function data($options)
	{
        if(empty($options['data']))
        {
            return response()->json([
                'message' => $options['nofound']
            ], 404);             
        }

        $data = [
        	"context" => $options['context'],
        	"data" => $options['data']
        ];

        return response()->json($data, 200);		
	}


	public static function invalidateContext($context)
	{
        return response()->json([
            'message' => 'Context non valide :',
            "erreurs" => $context["erreurs"]
        ], 405);  
	}
}