<?php

namespace App\Http\Controllers;

use Illuminate\Http\{ Request, RedirectResponse };
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Inertia\{ Inertia, Response as InertiaResponse };

abstract class InertiaCrudController extends Controller
{
    protected EloquentModel $model;

    protected function _index(string $view, int $paginate = 15, ?string $search = null, array $searchFields = []): InertiaResponse
    {   
        $data = $this->model->orderBy('created_at', 'desc');

        if($search && !empty($searchFields)) {
            foreach($searchFields as $searchField) {
                $data = $data->orWhere($searchField, 'LIKE', "%$search%");
            }
        }

        $data = $data
            ->paginate($paginate)
            ->appends(request()->query());

        return Inertia::render($view, compact('data', 'search'));
    }

    protected function _destroy(int $id): RedirectResponse
    {   
        $this->model->findOrFail($id)->delete();
        return redirect()->back();
    }

    protected function _edit(string $view, int $id): InertiaResponse
    {
        $data = $this->model->FindOrFail($id);
        return Inertia::render($view, compact('data'));
    }
}
