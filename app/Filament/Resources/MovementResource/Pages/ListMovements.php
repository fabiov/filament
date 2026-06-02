<?php

declare(strict_types=1);

namespace App\Filament\Resources\MovementResource\Pages;

use App\Filament\Resources\MovementResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListMovements extends ListRecords
{
    use ExposesTableToWidgets;

    protected Width|string|null $maxContentWidth = Width::Full;

    protected static string $resource = MovementResource::class;

    protected function getHeaderWidgets(): array
    {
        return MovementResource::getWidgets();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
