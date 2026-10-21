<?php

namespace App\Filament\Resources\Tags\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TagInfolist
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
                                    TextEntry::make('name')->label('Nama Label'),
                                    TextEntry::make('slug')->label('Slug'),
                                    TextEntry::make('updated_at')->label('Diperbarui Pada')->dateTime(),
                                    TextEntry::make('created_at')->label('Dibuat Pada')->dateTime(),
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
