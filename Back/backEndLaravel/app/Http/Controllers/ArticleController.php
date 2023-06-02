<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Blog;

use Illuminate\Support\Facades\DB;


class ArticleController extends \App\Http\Controllers\Controller
{
    public function store(CreateArticleRequest $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $author = $request->input('author');
        $category = $request->input('category');

        $article = new Blog();
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

    public function index()
    {
        $enables = DB::table('blog')
            ->where('deleted_at', null )
            ->get();
        return $enables;
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return response(status:200);
    }

}
