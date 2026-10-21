<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class ArticleStatusChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Status Artikel';

    protected ?string $maxHeight = '275px';

    public static function canView(): bool
    {
        return Auth::user()->can(['ViewAny:Article']);
    }

    public function getDescription(): ?string
    {
        $article = Article::count();

        return 'Jumlah Artikel: '.$article;
    }

    protected function getData(): array
    {
        $published = Article::where('status', 'published')->count();
        $draft = Article::where('status', 'draft')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Artikel',
                    'data' => [$published, $draft],
                    'backgroundColor' => [
                        '#6366f1',
                        '#10b981',
                    ],
                    'borderColor' => [
                        '#6366f1',
                        '#10b981',
                    ],
                ],
            ],
            'labels' => ['Diterbitkan', 'Draf'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
