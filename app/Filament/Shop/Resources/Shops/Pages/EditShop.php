<?php

namespace App\Filament\Shop\Resources\Shops\Pages;

use App\Filament\Shop\Resources\Shops\ShopResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class EditShop extends EditRecord
{
    protected static string $resource = ShopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Change Password')
                ->schema([
                    TextInput::make('password')
                        ->password()
                        ->revealable()
                        ->default(null),
                ]),
            DeleteAction::make(),
        ];
    }
}
