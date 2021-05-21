<?php
namespace App\Http\Controllers\Front;
use App\Repositories\PostRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, User, Tag};
use App\Http\Requests\Front\SearchRequest;
class PostController extends Controller
{
    protected $postRepository;
    protected $nbrPages;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->nbrPages = config('app.nbrPages.posts');
    }
    public function index()
    {
        $posts = $this->postRepository->getActiveOrderByDate($this->nbrPages);
        $heros = $this->postRepository->getHeros();
        return view('front.index', compact('posts', 'heros'));
    }
//posts by slug
    public function show(Request $request, $slug)
   {
    $post = $this->postRepository->getPostBySlug($slug);
    return view('front.post', compact('post'));
   }


//show posts by category
    public function category(Category $category)
    {
      $posts = $this->postRepository->getActiveOrderByDateForCategory($this->nbrPages, $category->slug);
      $title = __('Posts for category ') . '<strong>' . $category->title . '</strong>';
      return view('front.index', compact('posts', 'title'));
    }
//posts by author
     public function user(User $user)
    {
       $posts = $this->postRepository->getActiveOrderByDateForUser($this->nbrPages, $user->id);
       $title = __('Posts for author ') . '<strong>' . $user->name . '</strong>';
      return view('front.index', compact('posts', 'title'));
      }

      //posts by tag || étiquette
      public function tag(Tag $tag)
      {
          $posts = $this->postRepository->getActiveOrderByDateForTag($this->nbrPages, $tag->slug);
          $title = __('Posts for tag ') . '<strong>' . $tag->tag . '</strong>';
          return view('front.index', compact('posts', 'title'));
      }

      //recherche 
      public function search(SearchRequest $request)
     { 
       $search = $request->search;
       $posts = $this->postRepository->search($this->nbrPages, $search);
       $title = __('Posts found with search: ') . '<strong>' . $search . '</strong>';
       return view('front.index', compact('posts', 'title'));
     }
}