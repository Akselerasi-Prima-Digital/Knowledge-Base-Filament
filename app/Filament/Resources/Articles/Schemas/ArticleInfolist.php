<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Flex::make([
                            Grid::make(2)
                                ->schema([
                                    TextEntry::make('title')
                                        ->label('Judul'),
                                    TextEntry::make('slug')
                                        ->label('Slug'),
                                    TextEntry::make('category.name')
                                        ->label('Kategori'),

                                    TextEntry::make('tags.name')
                                        ->label('Label'),
                                    IconEntry::make('is_featured')
                                        ->boolean()
                                        ->label('Unggulan'),
                                    TextEntry::make('status')
                                        ->label('Status')
                                        ->badge()
                                        ->color(fn (string $state): string => match ($state) {
                                            'draft' => 'warning',
                                            'published' => 'success',
                                            default => 'gray',
                                        })
                                        ->formatStateUsing(fn (string $state): string => match ($state) {
                                            'draft' => 'Draf',
                                            'published' => 'Diterbitkan',
                                            default => $state,
                                        }),
                                    TextEntry::make('views')
                                        ->numeric()
                                        ->label('Dibaca'),
                                    TextEntry::make('user.name')
                                        ->label('Penulis'),
                                    TextEntry::make('updated_at')->label('Diperbarui Pada')
                                        ->dateTime(),
                                    TextEntry::make('created_at')->label('Dibuat Pada')
                                        ->dateTime(),
                                ]),
                        ]),
                    ]),
                Section::make('Konten')
                    ->schema([
                        TextEntry::make('content')->prose()->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }
}
