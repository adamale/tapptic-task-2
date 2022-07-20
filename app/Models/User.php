<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Collection<\App\Models\User> $likedUsers
 * @property \Illuminate\Support\Collection<\App\Models\User> $usersLikedBy
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

    public function usersLikedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'user_b_id', 'user_a_id');
    }

    public function pairs(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'pairs', 'user_a_id', 'user_b_id');
    }

    public function like(User $likedUser)
    {
        $this->likedUsers()->syncWithoutDetaching($likedUser->getKey());

        if ($this->isLikedBy($likedUser)) {
            $this->pairWith($likedUser);
        }
    }

    public function unlike(User $unlikedUser)
    {
        $this->likedUsers()->detach($unlikedUser->getKey());
        $this->unpairWith($unlikedUser);
    }

    public function isLikedBy(User $user): bool
    {
        return $this->usersLikedBy->contains($user);
    }

    public function pairWith(User $user)
    {
        $this->pairs()->syncWithoutDetaching($user->getKey());
        $user->pairs()->syncWithoutDetaching($this->getKey());
    }

    public function unpairWith(User $user)
    {
        $this->pairs()->detach($user->getKey());
        $user->pairs()->detach($this->getKey());
    }
}
