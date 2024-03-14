<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Http\Resources\Json\ResourceCollection;

interface PropertySearchContract
{
    public function __invoke(string $search = ''): ResourceCollection;
}
