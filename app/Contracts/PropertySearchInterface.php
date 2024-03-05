<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Http\Resources\Json\ResourceCollection;

interface PropertySearchInterface
{
    public function __invoke(string $search = ''): ResourceCollection;
}
