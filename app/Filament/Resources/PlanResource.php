<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Filament\Resources\PlanResource\RelationManagers;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->placeholder('Enter the plan  name')
                    ->required(),
                TextInput::make('current_amount')
                    ->label('Current Amount')
                    ->placeholder('Enter the current of plan amount')
                    ->required()
                    ->numeric(),
                TextInput::make('target_amount')
                    ->label('Target Amount')
                    ->placeholder('Enter the target of plan amount')
                    ->required()
                    ->numeric(),
                DatePicker::make('start_date')
                    ->label('Start Date')
                    ->placeholder('Select start date')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('End Date')
                    ->placeholder('Select end date')
                    ->required(),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),


                Select::make('user_id')
                    ->label('user')
                    ->relationship('user', 'name')
                    ->required(),
                RichEditor::make('note')
                    ->label('Note'),
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
                TextColumn::make('current_amount')
                    ->label('Current Amount')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('target_amount')
                    ->label('Target Amount')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Category'),

                TextColumn::make('user.name')
                    ->label('User Name'),
                TextColumn::make('note')
                    ->label('Note')
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
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
