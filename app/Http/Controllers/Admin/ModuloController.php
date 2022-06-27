<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Modulo\BulkDestroyModulo;
use App\Http\Requests\Admin\Modulo\DestroyModulo;
use App\Http\Requests\Admin\Modulo\IndexModulo;
use App\Http\Requests\Admin\Modulo\StoreModulo;
use App\Http\Requests\Admin\Modulo\UpdateModulo;
use App\Models\Modulo;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ModuloController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexModulo $request
     * @return array|Factory|View
     */
    public function index(IndexModulo $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Modulo::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['descripcion', 'id'],

            // set columns to searchIn
            ['descripcion', 'id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.modulo.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.modulo.create');

        return view('admin.modulo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreModulo $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreModulo $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Modulo
        $modulo = Modulo::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/modulos'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/modulos');
    }

    /**
     * Display the specified resource.
     *
     * @param Modulo $modulo
     * @throws AuthorizationException
     * @return void
     */
    public function show(Modulo $modulo)
    {
        $this->authorize('admin.modulo.show', $modulo);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Modulo $modulo
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Modulo $modulo)
    {
        $this->authorize('admin.modulo.edit', $modulo);


        return view('admin.modulo.edit', [
            'modulo' => $modulo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateModulo $request
     * @param Modulo $modulo
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateModulo $request, Modulo $modulo)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Modulo
        $modulo->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/modulos'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/modulos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyModulo $request
     * @param Modulo $modulo
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyModulo $request, Modulo $modulo)
    {
        $modulo->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyModulo $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyModulo $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Modulo::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
