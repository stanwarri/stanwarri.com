<?php

namespace App\Filament\Resources\CommunityMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CommunityMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('phone')
                    ->placeholder('Not provided'),
                
                TextColumn::make('bookDistribution.book.title')
                    ->label('Book Received')
                    ->placeholder('No book associated')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('bookDistribution.book.author')
                    ->label('Author')
                    ->placeholder('No book associated')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('how_found')
                    ->label('How Found')
                    ->placeholder('Not specified'),
                
                TextColumn::make('registered_at')
                    ->label('Registered')
                    ->dateTime()
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('book')
                    ->relationship('bookDistribution.book', 'title')
                    ->label('Book'),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('registered_at', 'desc');
    }
}
