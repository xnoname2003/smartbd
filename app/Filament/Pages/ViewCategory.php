<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use App\Models\ServiceCategory;
use App\Models\SearchKeyword;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

class ViewCategory extends Page
{
    protected string $view = 'filament.pages.view-category';
    protected static bool $shouldRegisterNavigation = false;
    public $categorySlug;
    public $categoryData;

    protected static ?string $slug = 'manage-categories/{slug}';

    public function mount($slug): void
    {
        $this->categorySlug = $slug;
        $this->loadData();

        // Kalau slug-nya ngasal, lempar ke halaman 404
        if (!$this->categoryData) {
            abort(404);
        }
    }

    public function loadData()
    {
        // 3. Cari data berdasarkan kolom 'slug', bukan 'id'
        $this->categoryData = ServiceCategory::with('searchKeywords')
            ->where('slug', $this->categorySlug)
            ->first();
    }

    public function getTitle(): string
    {
        return 'View Category Details';
    }

    public function addKeywordAction(): Action
    {
        return Action::make('addKeyword')
            ->modalHeading('Add Keyword')
            ->form([
                TextInput::make('keyword')
                    ->label('Keyword name')
                    ->placeholder('Enter a keyword name')
                    ->required(),
            ])
            ->action(function (array $data) {
                SearchKeyword::create([
                    // 4. Pastikan pakai ID dari categoryData yang sudah di-load untuk foreign key-nya
                    'service_category_id' => $this->categoryData->id, 
                    'keyword' => $data['keyword'],
                    'is_active' => true,
                ]);
                $this->loadData();

                Notification::make()
                    ->title('Keyword Ditambahkan')
                    ->success()
                    ->send();
            });
    }

    public function deleteKeywordAction(): Action
    {
        return Action::make('deleteKeyword')
            ->icon('heroicon-o-trash')
            ->requiresConfirmation()
            ->action(function (array $arguments) {
                SearchKeyword::find($arguments['id'])->delete();
                $this->loadData();
                Notification::make()
                    ->title('Keyword Dihapus')
                    ->success()
                    ->send();
            });
    }

    public function editKeywordAction(): Action
    {
        return Action::make('editKeyword')
            ->modalHeading('Edit Keyword')
            ->form([
                TextInput::make('keyword')
                    ->label('Keyword name')
                    ->required(),
            ])
            // Isi form otomatis dengan data keyword yang mau diedit
            ->fillForm(fn (array $arguments) => SearchKeyword::find($arguments['id'])->toArray())
            ->action(function (array $data, array $arguments) {
                // Update ke database
                SearchKeyword::find($arguments['id'])->update($data);
                $this->loadData(); // Refresh data
                Notification::make()
                    ->title('Keyword Diperbarui')
                    ->success()
                    ->send();
            });
    }
}
