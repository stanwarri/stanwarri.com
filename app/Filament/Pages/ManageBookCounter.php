<?php

namespace App\Filament\Pages;

use App\Models\BookCounter;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class ManageBookCounter extends Page
{
    protected string $view = 'filament.pages.manage-book-counter';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Calculator;

    protected static ?string $navigationLabel = 'Book Counter';

    protected static ?string $title = 'Manage Book Counter';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'books_given_out' => BookCounter::getBooksGivenOutCount(),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Book Counter Settings')
                    ->description('Update the total count of books given out to community members.')
                    ->schema([
                        TextInput::make('books_given_out')
                            ->label('Total Books Given Out')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->helperText('This count will be displayed on the public books page and will auto-increment when QR codes are scanned.')
                            ->suffixIcon('heroicon-m-book-open'),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        BookCounter::setBooksGivenOutCount($data['books_given_out']);

        Notification::make()
            ->title('Book counter updated successfully!')
            ->success()
            ->send();
    }
}
