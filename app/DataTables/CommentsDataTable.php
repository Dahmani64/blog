<?php
namespace App\DataTables;
use App\Models\Comment;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;
class CommentsDataTable extends DataTable
{
    use DataTableTrait;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('user', function($comment) {
                return $comment->user->name;
            })
            ->editColumn('approval', function($comment) {
                if($comment->user->valid) {
                    return $this->button(
                              'users.unvalid', 
                              $comment->user->id, 
                              'warning', 
                              __('Disapprove'), 
                              'thumbs-down',
                              'valid'
                          );
                } 
                return $this->button(
                          'users.valid', 
                          $comment->user->id, 
                          'success', 
                          __('Approve'), 
                          'thumbs-up',
                          'valid'
                      );
            })
            ->editColumn('post', function($comment) {
                //return '<a href="' . route('posts.display', $comment->post->slug) . '" target="_blank">' .  $comment->post->title . '</a>';
            })
            ->editColumn('created_at', function ($comment) {
                return formatDate($comment->created_at) . __(' at ') . formatHour($comment->created_at);
            })
            ->editColumn('action', function ($comment) {
                return $this->button(
                          'comments.edit', 
                          $comment->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ).  $this->button(
                          'comments.destroy', 
                          $comment->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this comment?')
                      );
            })
            ->rawColumns(['approval','created_at', 'post', 'action'])
            ->setRowClass(function ($comment) {
                return $comment->user->valid ? '' : 'alert-warning';
            });
    }
    public function query(Comment $comment)
    {
        // Show only redactor posts comments
        $query = isRole('redac') ? 
            $comment->whereHas('post.user', function ($query) {
                $query->where('users.id', auth()->id());
            }) : 
            $comment->newQuery();
        if(Route::currentRouteNamed('comments.indexnew')) {
            $query->has('unreadNotifications');
        }
        return $query->with('user:id,name,valid', 'post:id,title,slug');
    }
    public function html()
    {
        return $this->builder()
                    ->setTableId('comments-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->lengthMenu();
    }
    protected function getColumns()
    {
        return [
            Column::computed('user')->title(__('Author')),
            Column::computed('approval')->title(__('Approval'))->addClass('align-middle text-center'),
            Column::make('body')->title(__('Comment')),
            Column::computed('post')->title(__('Answer to')),
            Column::make('created_at')->title(__('Date')),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center'),
        ];
    }
    protected function filename()
    {
        return 'Comments_' . date('YmdHis');
    }
}