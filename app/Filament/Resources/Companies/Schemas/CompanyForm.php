<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Company Details")
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->tel()
                            ->required(),
                        RichEditor::make('terms')
                            ->default(null)
                            ->columnSpanFull(),
                        RichEditor::make('policy')
                            ->default(null)
                            ->columnSpanFull(),
                        FileUpload::make('logo')
                            ->required(),
                    ]),
                Repeater::make("Social Media")
                    ->label("Social Media")
                    ->columnSpanFull()
                    ->columns(2)
                    ->relationship('social_medias')
                    ->schema([
                        TextInput::make('icon')
                            ->required(),
                        TextInput::make('link')
                            ->required(),
                    ])
            ]);
    }
}
