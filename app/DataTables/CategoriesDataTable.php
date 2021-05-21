<?php
namespace App\DataTables;
use App\Models\Category;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
class CategoriesDataTable extends DataTable
{
    use DataTableTrait;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('posts_count', function ($category) {
                return $this->badge($category->posts_count, 'secondary');
            })
            ->editColumn('action', function ($category) {
                return $this->button(
                          'categories.edit', 
                          $category->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'categories.destroy', 
                          $category->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this category?')
                      );
            })
            ->rawColumns(['posts_count', 'action']);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $category)
    {
        return $category->withCount('posts');
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('categories-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->lengthMenu();
    }
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('title')->title(__('Title')),
            Column::make('slug')->title(__('Slug')),
            Column::computed('posts_count')->title(__('Posts'))->addClass('text-center align-middle'),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center'),
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Categories_' . date('YmdHis');
    }
}