<?php

namespace App\Filament\Shop\Resources\Orders;

use App\Filament\Shop\Resources\Orders\Pages\CreateOrder;
use App\Filament\Shop\Resources\Orders\Pages\EditOrder;
use App\Filament\Shop\Resources\Orders\Pages\ListOrders;
use App\Filament\Shop\Resources\Orders\Schemas\OrderForm;
use App\Filament\Shop\Resources\Orders\Tables\OrdersTable;
use App\Models\Order;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BellAlert;

    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        return Order::where('shop_id', Auth::guard('shop')->user()->id);
    }

    public static function canCreate(): bool
    {
        return false;
    }


    public static function form(Schema $schema): Schema
    {
        return OrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
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
            'index' => ListOrders::route('/'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
        ];
    }
}
