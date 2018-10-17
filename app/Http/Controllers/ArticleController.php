<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\ArticleResource;
use Validator;

class ArticleController extends Controller {

    public function index() {
//        $limit = request()->has("limit") ? request()->get("limit") : 10;
//        $offset = request()->has("limit") ? request()->get("offset") : 0;
//        return ArticleResource::collection(Article::limit($limit)->offset($offset)->get());

        return ArticleResource::collection(Article::paginate(10));
    }

    public function show(Article $article) {
        return new ArticleResource($article);
        //return response()->json(["data"=>new ArticleResource($article), "code"=>404]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required|min:6',
                    'body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(["data" => null, "message" => $validator->errors()], 422);
        }
        $article = Article::create($request->all());

        if ($article) {
            return response()->json(["data" => new ArticleResource($article), "message" => "article created."], 201);
        }

        return response(["data" => null, "message" => "can not create an Article"], 522);
    }

    public function update(Request $request,Article $article) {
//        $validator = Validator::make($request->all(), [
//                    'title' => 'required|min:6',
//                    'body' => 'required',
//        ]);
//         if ($validator->fails()) {
//            return response()->json(["data" => null, "message" => $validator->errors()], 422);
//        }
//        if(!$article){
//            return response()->json(['message' => 'Not Found!'], 404);
//        }
//        $article->update($request->all());
//       if ($article) {
//            return response()->json(["data" => new ArticleResource($article), "message" => "article updated."], 201);
//        }
//        return response()->json(['message' => 'Not Found!'], 404);
        
//        if(!$request->has('title') && $request->get("title")==''){
//            return response()->json(["data" => null, "message" => "title is required!"], 422);
//        }
//        return "hh";
    }

    public function delete(Article $article) {
        $article->delete();

        return response()->json(null, 204);
    }

}
