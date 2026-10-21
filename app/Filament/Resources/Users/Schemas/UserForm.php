<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserForm
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
                                        TextInput::make('name')
                                            ->label('Nama')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('email')
                                            ->label('Email')
                                            ->email()
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255),
                                        Select::make('roles')
                                            ->label('Peran')
                                            ->relationship(name: 'roles', titleAttribute: 'name', modifyQueryUsing: fn (Builder $query) => $query->where('name', '!=', 'Super Admin'))
                                            ->preload()
                                            ->searchable()
                                            ->required(),
                                        TextInput::make('password')
                                            ->label('Password')
                                            ->password()
                                            ->revealable()
                                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                                            ->dehydrated(fn ($state) => filled($state))
                                            ->required(fn (string $operation): bool => $operation === 'create')
                                            ->rule(Password::defaults())
                                            ->autocomplete('new-password')
                                            ->helperText(
                                                fn (string $operation): ?string => $operation === 'edit' ? 'Kosongkan jika tidak ingin mengubah password' : null
                                            ),
                                        TextInput::make('password_confirmation')
                                            ->label('Konfirmasi Password')
                                            ->password()
                                            ->revealable()
                                            ->same('password')
                                            ->requiredWith('password')
                                            ->dehydrated(false),
                                    ]),
                            ]),
                    ]),

            ])->columns(1);
    }
}
