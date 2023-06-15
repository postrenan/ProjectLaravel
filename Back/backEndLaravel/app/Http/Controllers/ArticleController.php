<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Pagination\CursorPaginator;



class ArticleController extends Controller
{
    public function store(CreateArticleRequest $request)
    {
        $articles = new Article();
        $articles->title = $request->input('title');
        $articles->content = $request->input('content');
        $articles->author = $request->input('author');
        $articles->category = $request->input('category');
        $articles->image = $request->input('image');

        $slug = Str::kebab(strip_tags($request->input('title')));
        $articles->slug = $slug;
        $articles->save();

    }

    public function update(int $articleId): bool
    {
        DB::table('article')
            ->where('id', $articleId)
            ->update(['deleted_at' => null]);
        return true;
    }

    public function create(Request $request):JsonResponse
    {
        $search = $request->input('search');
        $articles = DB::table('article')
            ->where('created_at', '=' , null)
            ->get();
        echo $articles;
        return response()->json(['articles' => $articles]);
    }
    public function index(Request $request): JsonResponse
    {
        $search = $request->input('search');
        $articles = DB::table('article')
                ->when(filled($search), function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');

            })->reorder('created_at', 'desc' )->get();


        return response()->json(['articles' => $articles]);
    }

    public function show(Request $request): JsonResponse
    {
        $slugValue = $request->input('search');
        $article = Article::query()
            ->where('slug', '=', $slugValue)
            ->get();

        return response()->json(['article' => $article]);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        $article->save();
        return response(status: 200);
    }

}
