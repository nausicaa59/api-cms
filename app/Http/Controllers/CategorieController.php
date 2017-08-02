<?php 

namespace App\Http\Controllers;

use RestHelpers;
use RestResponse;
use App\Categorie;
use Illuminate\Http\Request;


class CategorieController extends Controller 
{
    static $AUTHORIZES_FIELDS = [
        "categories",
        "id",
        "meta_title",
        "meta_description",
        "title",
        "slug",
        "description"
    ];
    

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $context = RestHelpers::contextCollection($request, self::$AUTHORIZES_FIELDS);
        if(!$context["valide"])
        {
            return RestResponse::invalidateContext($context);
        }

        $options = [
            "context" => $context,
            "nofound" => "Aucune catégories trouvée(s) !",
            "data" => Categorie::getAll($context['elements'])
        ];

        return RestResponse::data($options);
    }


    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show(Request $request, $id)
    {
        $context = RestHelpers::contextSingle($request, self::$AUTHORIZES_FIELDS);
        if(!$context["valide"])
        {
            return RestResponse::invalidateContext($context);
        }

        $options = [
            "context" => $context,
            "nofound" => "Aucune catégorie trouvée !",
            "data" => Categorie::getSpecificFields($id, $context['elements'])
        ];


        return RestResponse::data($options);
    }



    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {

    }



    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {

    }

}
?>