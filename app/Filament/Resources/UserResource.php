<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Organization;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255),

                TextInput::make('password')
                    ->required()
                    ->password()
                    ->revealable()
                    ->maxLength(255)
                    ->hiddenOn('edit'),

                TextInput::make('nip')
                    ->required()
                    ->maxLength(20),

                Select::make('organization_id')
                    ->label('Organisasi')
                    ->options(
                        Organization::all()->pluck('name','id') // Menampilkan nama organisasi dan id
                    )
                    ->searchable()
                    ->required(),
                    Forms\Components\Select::make('roles')
                    ->relationship(name: 'roles', titleAttribute:'name'),

                TextInput::make('nik')
                    ->required()
                    ->maxLength(16),

                TextInput::make('phone')
                    ->required()
                    ->maxLength(20),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('nip')->searchable(),
                TextColumn::make('nik')->searchable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('organization.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
