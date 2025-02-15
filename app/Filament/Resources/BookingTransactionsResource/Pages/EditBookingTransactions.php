<?php

namespace App\Filament\Resources\BookingTransactionsResource\Pages;

use App\Filament\Resources\BookingTransactionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookingTransactions extends EditRecord
{
    protected static string $resource = BookingTransactionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
