<?php
namespace App\DataTables;
use App\Models\Page;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
class PagesDataTable extends DataTable
{
    use DataTableTrait;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action', function ($page) {
                return $this->button(
                          'page', 
                          $page->slug, 
                          'success', 
                          __('Show'), 
                          'eye', 
                          '',
                          '_blank'
                      ). $this->button(
                          'pages.edit', 
                          $page->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'pages.destroy', 
                          $page->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this page?')
                      );
            })
            ->rawColumns(['action']);
    }
    public function query(Page $model)
    {
        return $model->newQuery();
    }
    public function html()
    {
        return $this->builder()
                    ->setTableId('pages-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->lengthMenu();
    }
    protected function getColumns()
    {
        return [
            Column::make('title')->title('Titre'),
            Column::make('slug')->title('Slug'),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center'),
        ];
    }
    protected function filename()
    {
        return 'Pages_' . date('YmdHis');
    }
}