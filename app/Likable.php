<?php

namespace App;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait Likable
{
    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(

            'select library_id, sum(liked) likes from likes group by library_id',
            'likes',
            'likes.library_id',
            'libraries.id'
        );
    }

    public function isLikedBy(User $user)
    {
//        return (bool)$user->likes
//            ->where('library', $this->id)
//            ->where('liked', true)
//            ->count();
        $like = $user->likes()->where('library_id', $this->id)->first();
        return (bool)$like;
    }

//    public function isDislikedBy(User $user)
//    {
//        return (bool)$user->likes
//            ->where('library_id', $this->id)
//            ->where('liked', false)
//            ->count();
//    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

//    public function dislike($user = null)
//    {
//        return $this->like($user, false);
//    }

    public function like($user = null)
    {
        $like = $user->likes()->where('library_id', $this->id)->first();

        if ($like) {

            $like->delete();
        } else {
            $this->likes()->updateOrCreate(
                [
                    'user_id' => $user ? $user->id : auth()->id(),
                ],
                [
                    'liked' => true,
                ]
            );
        }
    }
}
