<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\ArticleResource;

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
        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    public function update(Request $request, Article $article) {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function delete(Article $article) {
        $article->delete();

        return response()->json(null, 204);
    }

}
