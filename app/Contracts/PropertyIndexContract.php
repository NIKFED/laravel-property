<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Http\Resources\Json\ResourceCollection;

interface PropertyIndexContract
{
    public function __invoke(?int $perPage): ResourceCollection;
}
