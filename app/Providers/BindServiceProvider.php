<?php

declare(strict_types=1);

namespace App\Providers;

//use App\Actions\GetPropertyListAction;
use App\Actions\GetPropertyListWithFilterAction;
use App\Actions\GetSearchPropertyListAction;
use App\Contracts\PropertyIndexContract;
use App\Contracts\PropertySearchContract;
use Illuminate\Support\ServiceProvider;

final class BindServiceProvider extends ServiceProvider
{
    public array $bindings = [
        //        PropertyIndexContract::class => GetPropertyListAction::class,
        PropertyIndexContract::class  => GetPropertyListWithFilterAction::class,
        PropertySearchContract::class => GetSearchPropertyListAction::class,
    ];
}
