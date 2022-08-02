<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;

class BugPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.bug-page';

    public $children_no;
    public $children_ages;
 
    public function mount(): void
    {
        $this->form->fill();
    }
 
    protected function getFormSchema(): array 
    {
        return [
            TextInput::make('children_no')
                ->reactive()
                ->afterStateUpdated(function ($state, $set) {
                    if (filled($state)) {
                        $generated = array_fill_keys(range(1, $state), '');
                        //$generated = [1 => '', 2 => '', ....]
                        $set('children_ages', $generated);
                    }
                })
                ->integer(),

            KeyValue::make('children_ages')
                ->disableAddingRows()
                ->disableDeletingRows()
                ->disableEditingKeys(),
        ];
    } 
 
    public function submit(): void
    {
        dd($this->form->getState());
    }
}
