<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Judul')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                                if (($get('slug') ?? '') !== Str::slug($old)) {
                                                    return;
                                                }

                                                $set('slug', Str::slug($state));
                                            }),
                                        TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->alphaDash(),
                                    ]),
                                RichEditor::make('content')
                                    ->label('Konten')
                                    ->required()
                                    ->maxLength(65535)
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        [
                                            'h2',
                                            'h3',
                                            'bold',
                                            'italic',
                                            'underline',
                                            'strike',
                                            'code',
                                            'codeBlock',
                                            'subscript',
                                            'superscript',
                                        ], [
                                            'link',
                                            'blockquote',
                                            'bulletList',
                                            'orderedList',
                                            'alignStart',
                                            'alignCenter',
                                            'alignEnd',
                                            'attachFiles',
                                            'table',
                                        ], ['undo',
                                            'redo',
                                        ],
                                    ])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsVisibility('public')
                                    ->fileAttachmentsDirectory('article/'.time()),
                            ]),
                    ])->columnSpan(['lg' => 2]),
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Select::make('category_id')
                                    ->label('Kategori')
                                    ->relationship(name: 'category', titleAttribute: 'name')
                                    ->required(),
                                Select::make('tags')
                                    ->label('Label')
                                    ->relationship(name: 'tags', titleAttribute: 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                        TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique('tags', 'slug')
                                            ->alphaDash(),
                                    ]),
                                Toggle::make('is_featured')
                                    ->label('Unggulan')
                                    ->required(),
                                Select::make('status')
                                    ->label('Status')
                                    ->options(['draft' => 'Draf', 'published' => 'Diterbitkan'])
                                    ->default('draft')
                                    ->required(),
                            ])->columnSpan(['lg' => 1]),
                    ]),

            ])->columns(3);
    }
}
