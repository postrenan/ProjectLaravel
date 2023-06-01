<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use http\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function SaveArticle(Request $request){
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
            return response(status:401);
        }

    }
    public function GetArticle(){
        $enables = DB::table('blog')
            ->where('deleted_at', null )
            ->get();
        return $enables;
    }

    public function DeleteArticle(int $articleId){
        $toDelete = Blog::where('id','=', $articleId)
            ->first();
        $toDelete->delete();

        if($toDelete){
            return response(status:200);
        }else{
            return response(status:400);
        }
    }

    public function findArticle(string $searchWord){
            return DB::table('blog')
                ->where('title', '=', $searchWord)
                ->first();
    }
}
