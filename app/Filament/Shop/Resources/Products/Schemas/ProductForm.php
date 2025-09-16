<?php

namespace App\Filament\Shop\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rs.'),
                TextInput::make('discount_percentage')
                    ->required()
                    ->numeric()
                    ->suffix('%')
                    ->default(0),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('images')
                    ->required()
                    ->multiple()
                    ->columnSpanFull(),
            ]);
    }
}
