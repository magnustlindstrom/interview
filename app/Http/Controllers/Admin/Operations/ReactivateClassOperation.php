<?php

namespace App\Http\Controllers\Admin\Operations;

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

trait ReactivateClassOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupReactivateClassRoutes($segment, $routeName, $controller)
    {
        Route::post($segment . '/{id}/reactivate', [
            'as'        => $routeName . '.reactivate',
            'uses'      => $controller . '@reactivate',
            'operation' => 'reactivate',
        ]);
    }

    public function reactivate($id)
    {
        $this->crud->hasAccessOrFail('update');

        $this->crud->model->findOrFail($id)->update([
            'end_date' => Carbon::now()->toDateString(),
            'archived_at' => null
        ]);

        return (string) 'OK';
    }

    protected function setupReactivateDefaults()
    {
        $this->crud->allowAccess('update');

        $this->crud->operation('reactivate', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButtonFromView('line', 'reactivate', 'reactivate', 'end');
        });
    }
}