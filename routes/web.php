<?php
//original
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
use App\Http\Controllers\Front\{
    PostController as FrontPostController,
    CommentController as FrontCommentController,
    ContactController as FrontContactController,
    PageController as FrontPageController
};
use App\Http\Controllers\Back\{
    AdminController,
    PostController as BackPostController,
    UserController as BackUserController,
    ResourceController as BackResourceController
};
use App\Http\Controllers\Auth\RegisteredUserController;
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    Lfm::routes();
});

// Home
Route::name('home')->get('/', [FrontPostController::class, 'index']);
Route::name('category')->get('category/{category:slug}', [FrontPostController::class, 'category']);
Route::name('author')->get('author/{user}', [FrontPostController::class, 'user']);
Route::name('tag')->get('tag/{tag:slug}', [FrontPostController::class, 'tag']);
Route::name('page')->get('page/{page:slug}', FrontPageController::class);

Route::prefix('posts')->group(function () {
    Route::name('posts.display')->get('{slug}', [FrontPostController::class, 'show']);
    Route::name('posts.search')->get('', [FrontPostController::class, 'search']);
    Route::name('posts.comments')->get('{post}/comments', [FrontCommentController::class, 'comments']);
    Route::name('posts.comments.store')->post('{post}/comments', [FrontCommentController::class, 'store'])->middleware('auth');
});
Route::name('front.comments.destroy')->delete('comments/{comment}', [FrontCommentController::class, 'destroy']);

// Contact
Route::resource('contacts', FrontContactController::class, ['only' => ['create', 'store']]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



//Route::view('admin', 'back.layout');

/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------|
*/

Route::prefix('admin')->group(function () 
{

    Route::middleware('redac')->group(function ()
     {
  
        // Dashboard
        Route::name('admin')->get('/', [AdminController::class, 'index']);
        // Purge
        Route::name('purge')->put('purge/{model}', [AdminController::class, 'purge']);
        // Posts
        Route::resource('posts', BackPostController::class)->except(['show', 'create']);
        Route::name('posts.create')->get('posts/create/{id?}', [BackPostController::class, 'create']);
    
        // Users
        Route::name('users.valid')->put('valid/{user}', [BackUserController::class, 'valid']);
        Route::name('users.unvalid')->put('unvalid/{user}', [BackUserController::class, 'unvalid']);
        // Comments
        Route::resource('comments', BackResourceController::class)->except(['show', 'create', 'store']);
        Route::name('comments.indexnew')->get('newcomments', [BackResourceController::class, 'index']); 
  
    });

    Route::middleware('admin')->group(function () 
    {
        
        // Posts
        Route::name('posts.indexnew')->get('newposts', [BackPostController::class, 'index']);
        Route::resource('categories', BackResourceController::class)->except(['show']);
    
        // Users
        Route::resource('users', BackUserController::class)->except(['show', 'create', 'store']);
        Route::name('users.indexnew')->get('newusers', [BackResourceController::class, 'index']);

        // Contacts
        Route::resource('contacts', BackResourceController::class)->only(['index', 'destroy']);
        Route::name('contacts.indexnew')->get('newcontacts', [BackResourceController::class, 'index']);
 
        // Follows
        Route::resource('follows', BackResourceController::class)->except(['show']);
        // Pages
        Route::resource('pages', BackResourceController::class)->except(['show']);
    
    
    });
});

// Profile
Route::middleware(['auth', 'password.confirm'])->group(function () {
    Route::view('profile', 'auth.profile');
    Route::name('profile')->put('profile', [RegisteredUserController::class, 'update']);
    Route::name('deleteAccount')->delete('profile/delete',  [RegisteredUserController::class, 'destroy']);
});

require __DIR__.'/auth.php';