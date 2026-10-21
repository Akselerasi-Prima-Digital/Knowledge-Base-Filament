<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryInfolist
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
                                    TextEntry::make('name')->label('Nama Kategori'),
                                    TextEntry::make('slug')->label('Slug'),
                                    TextEntry::make('ordering')
                                        ->numeric()->label('Urutan'),
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
                                    TextEntry::make('updated_at')->label('Diperbarui Pada')
                                        ->dateTime(),
                                    TextEntry::make('created_at')->label('Dibuat Pada')
                                        ->dateTime(),
                                ]),
                        ]),
                    ]),
                Section::make('Deskripsi')
                    ->schema([
                        TextEntry::make('description')->prose()->hiddenLabel(),
                    ]),
            ]);
    }
}
