<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillResource\Pages;
use App\Filament\Resources\BillResource\RelationManagers;
use App\Models\Bill;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->placeholder('Enter the budget name')
                    ->required(),
                TextInput::make('amount')
                    ->label('Amount')
                    ->placeholder('Enter the budget amount')
                    ->required()
                    ->numeric(),
                DatePicker::make('payment_date')
                    ->label('Payment Date')
                    ->placeholder('Select payment date')
                    ->required(),

                Radio::make('Status')
                    ->label('Did you pay it')
                    ->boolean()
                    ->inline()->columnSpan('full'),

                DatePicker::make('period')
                    ->label('End Date')
                    ->placeholder('Select end date')
                    ->required(),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),

                Select::make('user_id')
                    ->label('User Name')
                    ->relationship('user', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Amount')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('payment_date')
                    ->label('Payment Date')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('period')
                    ->label('period')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('status')
                    ->label('Payment Status')
                    ->boolean(),
                TextColumn::make('category.name')
                    ->label('Category'),
                TextColumn::make('user.name')
                    ->label('User Name'),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListBills::route('/'),
            'create' => Pages\CreateBill::route('/create'),
            'edit' => Pages\EditBill::route('/{record}/edit'),
        ];
    }
}
