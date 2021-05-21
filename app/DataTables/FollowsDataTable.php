<?php
namespace App\DataTables;
use App\Models\Follow;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
class FollowsDataTable extends DataTable
{
    use DataTableTrait;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action', function ($follow) {
                return $this->button(
                          'follows.edit', 
                          $follow->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'follows.destroy', 
                          $follow->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this link?')
                      );
            })
            ->rawColumns(['action']);
    }
    public function query(Follow $model)
    {
        return $model->newQuery();
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('follows-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->lengthMenu();
    }
    protected function getColumns()
    {
        return [
            Column::make('title')->title(__('Title')),
            Column::make('href')->title('Link'),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center'),
        ];
    }
    protected function filename()
    {
        return 'Follows_' . date('YmdHis');
    }
}