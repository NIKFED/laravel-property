<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Http\Resources\Json\ResourceCollection;

interface PropertyIndexInterface
{
    public function __invoke(): ResourceCollection;
}
