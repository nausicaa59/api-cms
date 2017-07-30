<?php 

namespace App\Http\Controllers;


use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller 
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //?range=0-25
        $name = $request->input('range');
        var_dump($name);
        return response()->json(Article::with("categorie")->get());
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $article = Article::find($id);

        if(empty($article))
        {
            return response()->json([
                'message' => 'Article not found',
            ], 404);            
        }

        return response()->json([
            "data" => $article
        ], 200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
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