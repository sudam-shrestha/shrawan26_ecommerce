<?php

namespace App\Filament\Shop\Resources\Products\Pages;

use App\Filament\Shop\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['shop_id'] = Auth::guard('shop')->user()->id;
        return $data;
    }
}
