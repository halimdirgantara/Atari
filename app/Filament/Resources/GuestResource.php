<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Guest;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use function Laravel\Prompts\text;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\GuestResource\Pages;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GuestResource\RelationManagers;

class GuestResource extends Resource
{
    protected static ?string $model = Guest::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('phone')->required(),
            TextInput::make('address')->required(),
            TextInput::make('organization')->required(),
            TextInput::make('identity_id')->required(),
            FileUpload::make('identity_file')->disk('public')->directory('identities'),
            TextInput::make('guest_token')->default(Str::random(8))->required()->maxLength(50)->readonly(),
        ]);
        if (!isset($data['guest_token']) || empty($data['guest_token'])) {
            $data['guest_token'] = Str::random(8);
        }
        // Return data yang sudah dimodifikasi
        return Guest::create($data)->getKey();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('id')->searchable(),
            TextColumn::make('name')
                ->label('Name')
                ->sortable()
                ->searchable(),
            
            TextColumn::make('email')
                ->label('Email')
                ->sortable()
                ->searchable(),

            TextColumn::make('phone')
                ->label('Phone')
                ->sortable(),

            TextColumn::make('address')
                ->label('Address')
                ->limit(50) // Limit text to 50 characters
                ->sortable(),

            TextColumn::make('organization')
                ->label('Organization')
                ->sortable()
                ->searchable(),

            TextColumn::make('identity_id')
                ->label('Identity ID')
                ->sortable(),

                ImageColumn::make('author.avatar')->square()
                ->label('author.avatar')
                ->disk('public')
                ->size(50, 50),

            TextColumn::make('guest_token')
                ->label('Guest Token')
                ->copyable() // Allow copying of guest token
                ->sortable(),
            
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->sortable(),
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
            'index' => Pages\ListGuests::route('/'),
            'create' => Pages\CreateGuest::route('/create'),
            'edit' => Pages\EditGuest::route('/{record}/edit'),
        ];
    }
}
