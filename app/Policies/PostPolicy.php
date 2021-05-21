<?php
namespace App\Policies;
use App\Models\{ Post, User };
use Illuminate\Auth\Access\HandlesAuthorization;
class PostPolicy
{
    use HandlesAuthorization;
    protected function manage(User $user, Post $post)
    {
        return $user->isAdmin() ?: $user->id === $post->user_id;
    }
    public function viewAny(User $user)
    {
        return true;
    }
    public function view(User $user, Post $post)
    {
        return $this->manage($user, $post);
    }
    public function create(User $user)
    {
        return true;
    }
    public function update(User $user, Post $post)
    {
        return $this->manage($user, $post);
    }
    public function delete(User $user, Post $post)
    {
        return $this->manage($user, $post);
    }
}