<?php

namespace App\Filament\Resources\CommunityMembers\Tables;

use App\Filament\Exports\CommunityMemberExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                    ->label('Book')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('how_found')
                    ->label('How Found')
                    ->options([
                        'social_media' => 'Social Media',
                        'friend' => 'Friend/Referral',
                        'event' => 'Event',
                        'online' => 'Online Search',
                        'other' => 'Other',
                    ]),

                Filter::make('registration_date_range')
                    ->form([
                        TextInput::make('from')
                            ->type('date')
                            ->label('Registration Date From'),
                        TextInput::make('until')
                            ->type('date')
                            ->label('Registration Date Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn (Builder $query, $date): Builder => $query->whereDate('registered_at', '>=', $date))
                            ->when($data['until'], fn (Builder $query, $date): Builder => $query->whereDate('registered_at', '<=', $date));
                    }),

                Filter::make('has_phone')
                    ->label('Has Phone Number')
                    ->query(function (Builder $query): Builder {
                        return $query->whereNotNull('phone');
                    })
                    ->toggle(),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(CommunityMemberExporter::class),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('registered_at', 'desc');
    }
}
