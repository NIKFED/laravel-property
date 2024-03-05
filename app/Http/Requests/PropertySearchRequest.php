<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PropertySearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => 'integer',
            'search'   => 'string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
