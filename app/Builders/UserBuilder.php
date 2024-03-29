<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function whereName(string $value): self
    {
        return $this->where('name', 'ilike', "%$value%");
    }
}
