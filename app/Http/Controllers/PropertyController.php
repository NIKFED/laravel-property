<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\PropertyIndexInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

final class PropertyController extends Controller
{
    public function index(PropertyIndexInterface $propertyIndexAction): ResourceCollection
    {
        return $propertyIndexAction();
    }
}
