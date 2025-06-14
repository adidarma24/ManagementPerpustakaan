<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{


    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Hapus input untuk 'id' karena akan diisi otomatis oleh database
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true), // Menambahkan validasi email unik
                Forms\Components\Textarea::make('address')
                    ->label('Address')
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password() // Menambahkan input tipe password
                    ->required()
                    ->minLength(8), // Menambahkan validasi panjang minimal
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
                    ->sortable()
                    ->searchable()
                    ->badge() // Menampilkan peran sebagai badge
                    ->colors([
                        'primary' => 'Admin', // Warna biru untuk peran Admin
                        'success' => 'User', // Warna hijau untuk peran User
                        'danger' => 'Guest', // Warna merah untuk peran Guest
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->timezone('Asia/Jakarta') // Mengatur zona waktu ke Indonesia
                    ->sortable(),
                Tables\Columns\TextColumn::make('peminjaman_count')
                    ->counts('peminjaman')
                    ->label('Buku Dipinjam')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->label('Delete')
                    ->action(function (User $record) {
                        $record->delete();
                    })
                    ->requiresConfirmation()
                    ->color('danger'),
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
            RelationManagers\PeminjamanRelationManager::class,
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
