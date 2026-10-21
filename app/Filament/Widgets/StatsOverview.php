<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = -2;

    protected static bool $isLazy = false;

    protected function getColumns(): int|array
    {
        return [
            'default' => 1,
            'sm' => 2,
            'md' => 3,
        ];
    }

    protected function getStats(): array
    {
        $stats = [];

        if (Auth::user()->can('ViewAny:Category')) {
            $stats[] = Stat::make('Kategori', Category::where('status', 'published')->count())
                ->icon('heroicon-m-folder')
                ->color('success');
        }

        if (Auth::user()->can('ViewAny:Tag')) {
            $stats[] = Stat::make('Label', Tag::count())
                ->icon('heroicon-m-tag')
                ->color('info');
        }

        if (Auth::user()->can('ViewAny:Article')) {
            $stats[] = Stat::make('Artikel', Article::count())
                ->icon('heroicon-m-document')
                ->color('success');

            $stats[] = Stat::make('Draf Artikel', Article::where('status', 'draft')->count())
                ->icon('heroicon-m-document')
                ->color('warning');

            $stats[] = Stat::make('Artikel yang Dipublikasikan', Article::where('status', 'published')->count())
                ->icon('heroicon-m-document-check')
                ->color('success');
        } elseif (Auth::user()->can('View:Article')) {
            $userId = Auth::user()->uuid;

            $stats[] = Stat::make('Artikel Saya', Article::where('user_id', $userId)->count())
                ->icon('heroicon-m-document')
                ->color('success');

            $stats[] = Stat::make('Draft Saya', Article::where('user_id', $userId)->where('status', 'draft')->count())
                ->icon('heroicon-m-document')
                ->color('warning');

            $stats[] = Stat::make('Publikasi Saya', Article::where('user_id', $userId)->where('status', 'published')->count())
                ->icon('heroicon-m-document-check')
                ->color('success');
        }

        if (Auth::user()->can('ViewAny:User')) {
            $stats[] = Stat::make('Pengguna', User::whereDoesntHave('roles', function (Builder $query) {
                $query->where('name', 'Super Admin');
            })->count())
                ->icon('heroicon-m-users')
                ->color('primary');
        }

        return $stats;
    }
}
