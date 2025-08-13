<?php

namespace App\Filament\Resources\CommunityMembers;

use App\Filament\Resources\CommunityMembers\Pages\ListCommunityMembers;
use App\Filament\Resources\CommunityMembers\Pages\ViewCommunityMember;
use App\Filament\Resources\CommunityMembers\Schemas\CommunityMemberForm;
use App\Filament\Resources\CommunityMembers\Tables\CommunityMembersTable;
use App\Models\CommunityMember;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CommunityMemberResource extends Resource
{
    protected static ?string $model = CommunityMember::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Community Members';

    public static function form(Schema $schema): Schema
    {
        return CommunityMemberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommunityMembersTable::configure($table);
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
            'index' => ListCommunityMembers::route('/'),
            'view' => ViewCommunityMember::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }
}
