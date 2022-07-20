<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Collection<\App\Models\User> $likedUsers
 * @property \Illuminate\Support\Collection<\App\Models\User> $likedBy
 */
class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function likedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'user_a_id', 'user_b_id');
    }

    public function likedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'user_b_id', 'user_a_id');
    }

    public function like(User $user)
    {
        $this->likedUsers()->syncWithoutDetaching($user->getKey());
    }

    public function unlike(User $user)
    {
        $this->likedUsers()->detach($user->getKey());
    }
}
