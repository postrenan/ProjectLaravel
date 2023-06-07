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
        $title = $request->input('title');
        $content = $request->input('content');
        $author = $request->input('author');
        $category = $request->input('category');

        $articles = new Article();
        $articles->title = ($title);
        $articles->content = ($content);
        $articles->author = ($author);
        $articles->category = ($category);

        $slug = Str::kebab(strip_tags($title));
        $articles->slug = $slug;
        $articleUp = $articles->save();

        if ($articleUp) {
            return response(status: 200);
        } else {
            abort(400);
        }
    }

    public function update(int $articleId): bool
    {
        DB::table('article')
            ->where('id', $articleId)
            ->update(['deleted_at' => null]);
        return true;
    }

    public function index(Request $request): JsonResponse
    {
        $search = $request->input('search');
        $articles = Article::withTrashed()
            ->when(filled($search), function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })->get();
        return response()->json(['articles' => $articles]);
    }

    public function show(Request $request): JsonResponse
    {
        $slugValue = $request->input('search');
        $article = DB::table('article')
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
