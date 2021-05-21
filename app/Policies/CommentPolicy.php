<?php
namespace App\Policies;
use App\Models\{ Comment, User};
use Illuminate\Auth\Access\HandlesAuthorization;
class CommentPolicy
{
    use HandlesAuthorization;
    protected function manage(User $user, Comment $comment)
    {
        return $user->isAdmin() ?: $user->id === $comment->post->user_id || $user->id === $comment->user_id;
    }
    public function viewAny(User $user)
    {
        return true;
    }
    public function view(User $user, Comment $comment)
    {
        return true;
    }
    public function update(User $user, Comment $comment)
    {
        return $this->manage($user, $comment);
    }
    public function delete(User $user, Comment $comment)
    {
        return $this->manage($user, $comment);
    }
}