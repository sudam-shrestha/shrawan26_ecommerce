<?php

namespace App\Filament\Shop\Resources\Orders\Pages;

use App\Filament\Shop\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
