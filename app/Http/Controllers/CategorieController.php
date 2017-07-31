<?php 

namespace App\Http\Controllers;

use RestHelpers;
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
        $traitement = function($context) {
            return Categorie::getAll($context["elements"]);
        };

        $options = [
            "request" => $request,
            "autorizedFields" => self::$AUTHORIZES_FIELDS,
            "nofound" => "Aucune catégories trouvée(s) !",
            "traitement" => $traitement
        ];

        return $this->getCollection($options);
    }


    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show(Request $request, $id)
    {
        $traitement = function($context) use($id) {
            return Categorie::getSpecificFields($id, $context["elements"]);
        };
        
        $options = [
            "request" => $request,
            "autorizedFields" => self::$AUTHORIZES_FIELDS,
            "nofound" => "Aucune catégorie trouvée !",
            "traitement" => $traitement
        ];

        return $this->getSingle($options);
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