<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->icon(fn ($record) => $record->is_featured ? 'heroicon-s-star' : null)
                    ->iconPosition('after')
                    ->iconColor('warning'),
                TextColumn::make('category.name')
                    ->label('Topik')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => new HtmlString(
                        $record->tags->map(fn ($tag) => '<span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/30" style="margin-right: 4px; margin-top: 4px;">'.$tag->name.'</span>')->join('')
                    )),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
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
                    })
                    ->sortable(),
                TextColumn::make('views')
                    ->label('Dibaca')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Penulis')
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->label('Diperbarui Pada'),
                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->label('Dibuat Pada')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draf',
                        'published' => 'Diterbitkan',
                    ]),
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable(),
                SelectFilter::make('tags')
                    ->label('Label')
                    ->relationship('tags', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple(),
                TernaryFilter::make('is_featured')
                    ->label('Unggulan')
                    ->trueLabel('Unggulan')
                    ->falseLabel('Tidak Unggulan'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
