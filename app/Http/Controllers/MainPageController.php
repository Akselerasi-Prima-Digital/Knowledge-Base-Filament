<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Inertia\Inertia;

class MainPageController extends Controller
{
    public function index()
    {
        $searchUrl = route('home.search');
        $cacheCategories = Cache::remember('home_categories', now()->addHours(1), fn () => Category::select('uuid', 'name', 'description', 'slug')
            ->with(['articles' => function ($query) {
                $query->where('status', 'published')
                    ->limit(5)
                    ->orderByDesc('updated_at')
                    ->select('title', 'slug', 'category_id');
            }])
            ->withCount(['articles as articles_count' => function ($query) {
                $query->where('status', 'published');
            }])
            ->where('status', 'published')
            ->orderBy('ordering')
            ->get()
            ->map(fn ($category) => [
                'name' => $category->name,
                'description' => $category->description,
                'slug' => route('home.category', $category->slug),
                'articles_count' => $category->articles_count,
                'articles' => $category->articles->map(fn ($article) => [
                    'title' => $article->title,
                    'slug' => route('home.article', $article->slug),
                ]),
            ]));

        $cacheFeaturedArticles = Cache::remember('home_featured_articles', now()->addHours(1), fn () => Article::select('title', 'slug')
            ->where('is_featured', true)
            ->where('status', 'published')
            ->orderByDesc('updated_at')
            ->limit(6)
            ->get()
            ->map(fn ($article) => [
                'title' => $article->title,
                'slug' => route('home.article', $article->slug),
            ]));

        return Inertia::render('Index', [
            'categories' => $cacheCategories,
            'featuredArticles' => $cacheFeaturedArticles,
            'searchUrl' => $searchUrl,
        ]);
    }

    public function search(Request $request)
    {
        abort_unless($request->ajax(), 404);

        $validated = $request->validate([
            'query' => ['nullable', 'string', 'max:100'],
        ]);

        $query = $validated['query'] ?? null;

        if (! $query) {
            return response()->json([]);
        }

        $keywords = explode(' ', $query);

        $articles = Article::where(function (Builder $q) use ($keywords) {
            $q->where(function (\Illuminate\Contracts\Database\Query\Builder $subMsg) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $subMsg->where('title', 'like', "%{$keyword}%");
                }
            })->orWhere(function (\Illuminate\Contracts\Database\Query\Builder $subMsg) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $subMsg->where('content', 'like', "%{$keyword}%");
                }
            });
        })
            ->limit(10)
            ->get()
            ->map(fn ($article) => [
                'title' => $article->title,
                'content' => Str::limit(strip_tags($article->content), 125, '...'),
                'slug' => route('home.article', $article->slug),
            ]);

        return response()->json($articles);
    }

    public function category(Category $category)
    {
        $page = request()->input('page', 1);
        $cacheKey = 'category_'.$category->slug.'_page_'.$page;

        $cacheCategory = Cache::remember($cacheKey, now()->addHours(1), function () use ($category) {
            $articles = $category->articles()
                ->where('status', 'published')
                ->orderByDesc('updated_at')
                ->paginate(6)
                ->onEachSide(1);

            $articles->through(fn ($article) => [
                'title' => $article->title,
                'content' => Str::words(strip_tags($article->content), 20, '...'),
                'updated_at' => $article->updated_at->locale('id')->translatedFormat('j M Y'),
                'slug' => route('home.article', $article->slug),
            ]);

            return [
                'name' => $category->name,
                'meta_description' => Str::limit(preg_replace('/\s+/', ' ', strip_tags($category->description)), 155, '...'),
                'description' => $category->description,
                'articles_count' => $category->articles()->where('status', 'published')->count(),
                'articles' => $articles,
            ];
        });

        return Inertia::render('Category', ['category' => $cacheCategory]);
    }

    public function tag(Tag $tag)
    {
        $page = request()->input('page', 1);
        $cacheKey = 'tag_'.$tag->slug.'_page_'.$page;

        $cacheTag = Cache::remember($cacheKey, now()->addHours(1), function () use ($tag) {
            $articles = $tag->articles()
                ->where('status', 'published')
                ->orderByDesc('updated_at')
                ->paginate(6)
                ->onEachSide(1);

            $articles->through(fn ($article) => [
                'title' => $article->title,
                'content' => Str::words(strip_tags($article->content), 20, '...'),
                'updated_at' => $article->updated_at->locale('id')->translatedFormat('j M Y'),
                'slug' => route('home.article', $article->slug),
            ]);

            return [
                'name' => $tag->name,
                'meta_description' => Str::limit(preg_replace('/\s+/', ' ', strip_tags($tag->description)), 155, '...'),
                'description' => $tag->description,
                'articles_count' => $tag->articles()->where('status', 'published')->count(),
                'articles' => $articles,
            ];
        });

        return Inertia::render('Tag', ['tag' => $cacheTag]);
    }

    public function article(Article $article)
    {
        abort_if($article->status !== 'published', 404);

        $cacheKey = 'article_'.$article->slug;

        $cacheArticle = Cache::remember($cacheKey, now()->addHours(12), function () use ($article) {
            $article->load(['category', 'tags']);

            return [
                'title' => $article->title,
                'meta_description' => Str::limit(preg_replace('/\s+/', ' ', strip_tags($article->content)), 155, '...'),
                'content' => $article->content,
                'updated_at' => $article->updated_at->locale('id')->translatedFormat('j M Y'),
                'category' => [
                    'name' => $article->category->name,
                    'slug' => route('home.category', $article->category->slug),
                ],
                'tags' => $article->tags->map(fn ($tag) => [
                    'name' => $tag->name,
                    'slug' => route('home.tag', $tag->slug),
                ]),
            ];
        });

        return Inertia::render('Article', [
            'article' => $cacheArticle,
        ]);
    }
}
