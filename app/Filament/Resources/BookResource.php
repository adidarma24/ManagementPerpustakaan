<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';
    protected static ?string $label = 'Book';
    protected static ?string $pluralLabel = 'Books';
    protected static ?string $navigationGroup = 'Library Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required(),
                Forms\Components\TextInput::make('year')
                    ->label('Year')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('isbn')
                    ->label('ISBN')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->required(),
                Forms\Components\FileUpload::make('cover')
                    ->label('Cover')
                    ->image()
                    ->directory('covers') // Aktifkan penyimpanan ke folder covers
                    ->nullable(),
                Forms\Components\Select::make('publisher_id')
                    ->label('Publisher')
                    ->relationship('publisher', 'name')
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\Select::make('author_id')
                    ->label('Author')
                    ->relationship('author', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Year')
                    ->sortable(),
                Tables\Columns\TextColumn::make('isbn')
                    ->label('ISBN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('cover')
                    ->label('Cover'), // Menampilkan cover sebagai gambar
                Tables\Columns\TextColumn::make('publisher.name')
                    ->label('Publisher')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(), 
                Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->query(Book::query());
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
