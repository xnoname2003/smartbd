<?php

namespace App\Filament\Pages;

use App\Models\ServiceCategory;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Navigation\NavigationItem;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class ManageCategories extends Page
{
    protected string $view = 'filament.pages.manage-categories';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquare2Stack;

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Search Keywords & Categories';

    protected static ?string $title = 'Manajemen Kategori & Keyword';

    public function getCategoriesProperty()
    {
        return ServiceCategory::with('searchKeywords')->get();
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('New category')
                ->model(ServiceCategory::class)
                ->color('warning')
                ->successNotificationTitle('Kategori berhasil dibuat!')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')->required()->unique(),
                ]),
        ];
    }

    public function editCategoryAction(): Action
    {
        return Action::make('editCategory')
            ->modalHeading('Edit Category')
            ->form([
                TextInput::make('name')->required(),
                TextInput::make('slug')->required(),
            ])
            ->fillForm(fn (array $arguments) => ServiceCategory::find($arguments['id'])->toArray())
            ->action(function (array $data, array $arguments) {
                ServiceCategory::find($arguments['id'])->update($data);

                Notification::make()
                    ->title('Berhasil diperbarui')
                    ->body('Data kategori berhasil disimpan.')
                    ->success()
                    ->send();
            });
    }

    public function deleteCategoryAction(): Action
    {
        return Action::make('deleteCategory')
            ->requiresConfirmation()
            ->color('danger')
            ->action(function (array $arguments) {
                ServiceCategory::find($arguments['id'])->delete();

                Notification::make()
                    ->title('Kategori Dihapus')
                    ->body('Kategori beserta seluruh keyword di dalamnya telah dihapus.')
                    ->success()
                    ->send();
            });
    }

    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make(static::getNavigationLabel())
                ->group(static::getNavigationGroup())
                ->icon(static::getNavigationIcon())
                ->url(static::getUrl())
                // INI KUNCINYA: Menu ini bakal terus nyala kalau user ada di halaman ManageCategories ATAU ViewCategory
                ->isActiveWhen(fn () => request()->routeIs(static::getRouteName(), ViewCategory::getRouteName())),
        ];
    }
}
