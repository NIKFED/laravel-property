<?php

declare(strict_types=1);

namespace App\Models;

use App\Contracts\SearchableContract;
use App\Models\Traits\Searchable;
use Database\Factories\PropertyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Property
 *
 * @property int $id
 * @property int $user_id
 * @property int $price
 * @property int $storeys
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $description
 * @property array $tags
 * @property-read User $user
 *
 * @method static PropertyFactory factory($count = null, $state = [])
 */
final class Property extends Model implements SearchableContract
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'price',
        'storeys',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'tags' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'property_room');
    }

    public function toSearchArray(): array
    {
        return [
            ...$this->only(['id', 'description', 'tags']),
            'rooms' => $this->rooms->map(fn(Room $room) => $room->toSearchArray())->toArray(),
        ];
    }
}
