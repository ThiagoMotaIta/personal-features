<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\PortalNew;

class PortalNewController extends Controller
{
    public function index(){

        // Ready some lists
        $categories = Category::get();
        
        return view('home', compact('categories'));
        
    }


    public function getAllNews(){

        $news = PortalNew::get();
        
        if ($news->count() > 0){

            foreach ($news as $new){
                $author = User::where('id',$new->author_id)->first();
                $category = Category::where('id',$new->category_id)->first();

                if ($new->published == 'P'){
                    $published = 'Publicada';
                } else {
                    $published = 'Aguardando Publicação';
                }

                $item[] = ['id'=>$new->id, 'published'=>$published, 'author'=>$author->name, 'category'=>$category->category, 'title'=>$new->title, 'resume'=>$new->resume, 'description'=>$new->description];

            }

            return $item;

        } else {
            $news = PortalNew::get()->toJson(JSON_PRETTY_PRINT);
            return response($news, 200);
        }
        
    }


    public function getAllNewsBySearch(Request $request){

        $news = PortalNew::where('title', 'like', "%".$request->param."%")->get();

        if ($news == null){
            $category = Category::where('category', 'like', "%".$request->param."%")->first();
            $news = PortalNew::where('category_id',$category->id)->get();
        } else {
            $news = PortalNew::where('title', 'like', "%".$request->param."%")->get();
        }

        if ($news->count() > 0){

            foreach ($news as $new){
                $author = User::where('id',$new->author_id)->first();
                $category = Category::where('id',$new->category_id)->first();

                if ($new->published == 'P'){
                    $published = 'Publicada';
                } else {
                    $published = 'Aguardando Publicação';
                }

                $item[] = ['id'=>$new->id, 'published'=>$published, 'author'=>$author->name, 'category'=>$category->category, 'title'=>$new->title, 'resume'=>$new->resume, 'description'=>$new->description];

            }

            return $item;

        } else {
            return response($news->toJson(JSON_PRETTY_PRINT), 200);
        }
        
    }


    public function addNew(Request $request) {

        if ($request->published != "P"){
            $request->published = "N";
        }

        $portalNew = new PortalNew;
        $portalNew->title = $request->title;
        $portalNew->resume = $request->resume;
        $portalNew->description = $request->description;
        $portalNew->author_id = auth()->user()->id;
        $portalNew->category_id = $request->category_id;
        $portalNew->published = $request->published;
        $portalNew->save();

        return response()->json([
            "message" => "Notícia Cadastrada com Sucesso!"
        ], 201);

    }


    public function deleteNew(Request $request){
        if(PortalNew::where('id', $request->new_id)->exists()) {
            $portalNew = PortalNew::find($request->new_id);
            $portalNew->delete();

            return response()->json([
              "message" => "Notícia deletada com sucesso!"
            ], 202);
          } else {
            return response()->json([
              "message" => "Notícia não encontrada!"
            ], 404);
          }
    }


    public function getNewById(Request $request){
        
        $news = PortalNew::find($request->new_id);
        
        return response($news->toJson(JSON_PRETTY_PRINT), 200);
        
    }


    public function editNew(Request $request) {

        if (PortalNew::where('id', $request->new_id)->exists()) {

            if ($request->published != "P"){
                $request->published = "N";
            }

            $portalNew = PortalNew::find($request->new_id);
            $portalNew->title = $request->title;
            $portalNew->resume = $request->resume;
            $portalNew->description = $request->description;
            $portalNew->author_id = auth()->user()->id;
            $portalNew->category_id = $request->category_id;
            $portalNew->published = $request->published;
            $portalNew->save();

            return response()->json([
                "message" => "Notícia editada com sucesso!"
            ], 200);
        } else {
            return response()->json([
                "message" => "Notícia não encontrada."
            ], 404);

        }

    }
}
