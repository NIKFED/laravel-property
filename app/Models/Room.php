<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\RoomFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Room
 *
 * @property int $id
 * @property string $entity
 * @property int $count
 * @property array $additional_info
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static RoomFactory factory($count = null, $state = [])
 */
final class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity',
        'count',
        'additional_info',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'additional_info' => 'json',
    ];

    public function toSearchArray(): array
    {
        return $this->only('additional_info');
    }
}
