<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Models\Account;
use App\Models\User;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->maxLength(255)
                ->required(),
            Forms\Components\Select::make('status')
                ->options(['closed' => 'Closed', 'open' => 'Open', 'highlight' => 'Highlight'])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->actions([\Filament\Actions\EditAction::make()])
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('status')
                    ->alignCenter()
                    ->badge()
                    ->colors(['primary' => 'open', 'success' => 'highlight', 'danger' => 'closed']),
            ])
            ->filters([])
            ->bulkActions([\Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()])])
            ->defaultPaginationPageOption(25);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }

    /**
     * @return Builder<Account>
     */
    public static function getEloquentQuery(): Builder
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Builder<Account> $query */
        $query = parent::getEloquentQuery();

        return $query->where('user_id', '=', $user->id);
    }
}
