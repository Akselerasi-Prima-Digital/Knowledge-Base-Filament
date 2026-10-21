<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class ArticlesByCategoryChart extends ChartWidget
{
    protected ?string $heading = 'Artikel berdasarkan Kategori';

    protected ?string $maxHeight = '275px';

    public static function canView(): bool
    {
        return Auth::user()->can(['ViewAny:Article', 'View:Article', 'ViewAny:Category', 'View:Category']);
    }

    public function getDescription(): ?string
    {
        return '5 Kategori Teratas';
    }

    protected function getData(): array
    {
        $categories = Category::where('status', 'published')
            ->withCount('articles')
            ->orderByDesc('articles_count')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Artikel',
                    'data' => $categories->pluck('articles_count')->toArray(),
                    'backgroundColor' => '#6366f1',
                    'borderColor' => '#6366f1',
                    'borderRadius' => 4,
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
