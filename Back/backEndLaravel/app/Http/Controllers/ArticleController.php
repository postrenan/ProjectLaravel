<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArticleController extends \App\Http\Controllers\Controller
{
    public function store(CreateArticleRequest $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $author = $request->input('author');
        $category = $request->input('category');

        $article = new Article();
        $article->title = strip_tags($title);
        $article->content = strip_tags($content);
        $article->author = strip_tags($author);
        $article->category = strip_tags($category);

        $articleUp = $article->save();

        if($articleUp){
            return response(status:200);
        } else {
            abort(400);
        }
    }

    public function index(string $searchArticleInput)
    {
        $matchWord = DB::table('article')
            ->where('title', '=', $searchArticleInput)
            ->get();
        $enabled = DB::table('article')
            ->where('deleted_at', null )
            ->get();
        $disabled = DB::table('article')
            ->where('deleted_at', '!=' , null )
            ->get();

        return response(['resultWord'=>$matchWord,  'enable'=>$enabled, 'disable' => $disabled]);
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return response(status:200);
    }

}
