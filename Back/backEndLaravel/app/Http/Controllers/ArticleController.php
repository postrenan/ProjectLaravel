<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function store(CreateArticleRequest $request)
    {
        $articles = new Article();
        $articles->title = $request->input('title');
        $articles->content = $request->input('content');
        $articles->author_id = $request->input('author');
        $articles->category = $request->input('category');

        $slug = Str::kebab(strip_tags($request->input('title')));
        $articles->save();

        return response()->json();

    }

    public function update(int $articleId): JsonResponse
    {
        Article::find($articleId)->restore();

        return response()->json();
    }

    public function create(Request $request):JsonResponse
    {
        $search = $request->input('search');
        $articles = DB::table('article')
            ->where('deleted_at', '=' , null)
            ->get();

        return response()->json(['articles' => $articles]);
    }
    public function index(Request $request): JsonResponse
    {
        $search = $request->input('search');
        $articles = Article::query()
                ->when(filled($search), function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })->orderByDesc('created_at' )->get();


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

    public function destroy(Article $article): void
    {
        Article::find($article->id)->delete();
    }
}
