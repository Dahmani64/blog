<?php
namespace App\DataTables;
use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;
class UsersDataTable extends DataTable
{
    use DataTableTrait;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('valid', function ($user) {
                return $user->valid ? '<i class="fas fa-check"></i>' : '';
            })
            ->editColumn('created_at', function ($user) {
                return formatDate($user->created_at);
            })
            ->editColumn('updated_at', function ($user) {
                return formatDate($user->updated_at);
            })
            ->addColumn('action', function ($user) {
                return $this->button(
                          'users.edit', 
                          $user->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'users.destroy', 
                          $user->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this user?')
                      );
            })
            ->rawColumns(['valid', 'action']);
    }
    public function query(User $model)
    {
        if(Route::currentRouteNamed('users.indexnew')) {
            return $model->has('unreadNotifications');
        }
        return $model->newQuery();
    }
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->lengthMenu();
    }
    protected function getColumns()
    {
        return [
            Column::make('name')->title(__('Name')),
            Column::make('email')->title(__('Email')),
            Column::make('role')->title(__('Role')),
            Column::make('created_at')->title('Creation'),
            Column::make('updated_at')->title('Modification'),
            Column::make('valid')->title(__('Valid'))->addClass('align-middle text-center'),            
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center'),
        ];
    }
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}