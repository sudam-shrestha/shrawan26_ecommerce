<?php

namespace App\Filament\Shop\Resources\Shops;

use App\Filament\Shop\Resources\Shops\Pages\CreateShop;
use App\Filament\Shop\Resources\Shops\Pages\EditShop;
use App\Filament\Shop\Resources\Shops\Pages\ListShops;
use App\Filament\Shop\Resources\Shops\Schemas\ShopForm;
use App\Filament\Shop\Resources\Shops\Tables\ShopsTable;
use App\Models\Shop;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ShopResource extends Resource
{
    protected static ?string $model = Shop::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingStorefront;

    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = "Profile";
    protected static ?string $pluralModelLabel = "Profile";

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return Shop::where('id', Auth::guard('shop')->user()->id);
    }

    public static function form(Schema $schema): Schema
    {
        return ShopForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShopsTable::configure($table);
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
            'index' => ListShops::route('/'),
            'create' => CreateShop::route('/create'),
            'edit' => EditShop::route('/{record}/edit'),
        ];
    }
}
