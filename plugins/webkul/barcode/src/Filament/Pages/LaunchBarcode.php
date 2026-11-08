<?php

namespace Webkul\Barcode\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Filament\Pages\PageConfiguration;
use Filament\Panel;
use Illuminate\Support\Facades\Route;
use Webkul\Support\Enums\NavigationGroup;

class LaunchBarcode extends Page
{
    use HasPageShield;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-qr-code';

    protected static ?string $slug = 'barcode-app';

    public static function routes(Panel $panel, ?PageConfiguration $configuration = null): void
    {
        $middleware = static::getRouteMiddleware($panel);

        if ($configuration) {
            $middleware[] = "page-configuration:{$configuration->getKey()}";
        }

        Route::get(static::getRoutePath($panel), static fn () => redirect()->route('barcode.dashboard'))
            ->middleware($middleware)
            ->withoutMiddleware(static::getWithoutRouteMiddleware($panel))
            ->name(static::getRelativeRouteName($panel));
    }

    public static function getNavigationLabel(): string
    {
        return __('barcode::app.filament.navigation.label');
    }

    public static function getNavigationGroup(): string|\UnitEnum
    {
        return NavigationGroup::Barcode;
    }

    public function getTitle(): string
    {
        return __('barcode::app.filament.navigation.label');
    }
}
