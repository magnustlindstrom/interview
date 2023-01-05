<?php

namespace App\Http\Controllers\Admin\Operations;

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

trait ArchiveClassOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupPublishRoutes($segment, $routeName, $controller)
    {
        Route::post($segment . '/{id}/archive', [
            'as'        => $routeName . '.archive',
            'uses'      => $controller . '@archive',
            'operation' => 'archive',
        ]);
    }

    public function archive($id)
    {
        $this->crud->hasAccessOrFail('update');
        $this->crud->setOperation('Archive');

        $this->crud->model->findOrFail($id)->update([
            'end_date' => Carbon::now()->subDay()->toDateString(),
            'archived_at' => Carbon::now()
        ]);

        return (string) 'OK';
    }

    protected function setupArchiveDefaults()
    {
        $this->crud->allowAccess('archive');

        $this->crud->operation(['list', 'show'], function () {
            $this->crud->addButtonFromView('line', 'archive', 'archive', 'end');
        });
    }
}