<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingTransactionsResource\Pages;
use App\Filament\Resources\BookingTransactionsResource\RelationManagers;
use App\Models\BookingTransactions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingTransactionsResource extends Resource
{
    protected static ?string $model = BookingTransactions::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('booking_trx_id')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('total_amount')
                ->required()
                ->numeric()
                ->prefix('IDR'),
                Forms\Components\TextInput::make('duration')
                ->required()
                ->numeric()
                ->prefix('Days'),
                Forms\Components\DatePicker::make('started_at')
                ->required(),
                Forms\Components\DatePicker::make('ended_at')
                ->required(),
                Forms\Components\Select::make('is_paid')
                ->options([
                    true => 'Paid',
                    false => 'Not Paid',
                    ])
                ->required(),
                Forms\Components\Select::make('office_space_id')
               ->relationship('officeSpace','name')
               ->searchable()
               ->preLoad()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_trx_id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('officeSpace.name'),
                Tables\Columns\TextColumn::make('total_amount'),
                Tables\Columns\TextColumn::make('started_at')
                ->date(),
                Tables\Columns\IconColumn::make('is_paid')
                ->boolean()
                ->trueColor('danger')
                ->falseColor('success')
                ->trueIcon('heroicon-o-x-circle')
                ->falseIcon('heroicon-o-check-circle')
                ->label('Sudah Bayar ?'),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransactions::route('/create'),
            'edit' => Pages\EditBookingTransactions::route('/{record}/edit'),
        ];
    }
}
