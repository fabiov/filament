<?php

namespace App\Filament\Resources\ProvisionResource\Pages;

use App\Filament\Resources\ProvisionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListProvisions extends ListRecords
{
    protected Width|string|null $maxContentWidth = Width::Full;

    protected static string $resource = ProvisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
