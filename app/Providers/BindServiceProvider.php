<?php

declare(strict_types=1);

namespace App\Providers;

//use App\Actions\GetPropertyListAction;
use App\Actions\GetPropertyListWithFilterAction;
use App\Contracts\PropertyIndexInterface;
use Illuminate\Support\ServiceProvider;

final class BindServiceProvider extends ServiceProvider
{
    public array $bindings = [
//        PropertyIndexInterface::class => GetPropertyListAction::class,
        PropertyIndexInterface::class => GetPropertyListWithFilterAction::class,
    ];
}