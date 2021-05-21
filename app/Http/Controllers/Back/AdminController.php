<?php
namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use App\Models\{ User, Post, Comment, Contact };
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index(Post $post, User $user, Comment $comment, Contact $contact)
    {
        $users = isRole('admin') ? $this->getUnreads($user) : null;
        $contacts = isRole('admin') ? $this->getUnreads($contact) : null;
        $posts = isRole('admin') ? $this->getUnreads($post) : null;
        $comments = $this->getUnreads($comment, isRole('redac'));
        return view('back.index', compact('posts', 'users', 'contacts', 'comments'));
    }
    protected function getUnreads($model, $redac = null)
    {
        $query = $redac ? 
            $model->whereHas('post.user', function ($query) {
                $query->where('users.id', auth()->id());
            }) :
            $model->newQuery();
        return $query->has('unreadNotifications')->count();
    }
    public function purge($model)
    {
        $model = 'App\Models\\' . ucfirst($model);
        DB::table('notifications')->where('notifiable_type', $model)->delete();
        return back();
    }
}