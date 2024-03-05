<?php

declare(strict_types=1);

namespace App\Providers;

//use App\Actions\GetPropertyListAction;
use App\Actions\GetPropertyListWithFilterAction;
use App\Actions\GetSearchPropertyListAction;
use App\Contracts\PropertyIndexInterface;
use App\Contracts\PropertySearchInterface;
use Illuminate\Support\ServiceProvider;

final class BindServiceProvider extends ServiceProvider
{
    public array $bindings = [
        //        PropertyIndexInterface::class => GetPropertyListAction::class,
        PropertyIndexInterface::class => GetPropertyListWithFilterAction::class,
        PropertySearchInterface::class => GetSearchPropertyListAction::class,
    ];
}
