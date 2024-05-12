<?php

declare(strict_types=1);

namespace App\Contracts;

interface SearchableContract
{
    public static function bootSearchable(): void;

    public function getSearchIndex(): string;

    public function getSearchType(): string;

    public function toSearchArray(): array;
}