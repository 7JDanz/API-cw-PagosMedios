<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TipoDocumento\BulkDestroyTipoDocumento;
use App\Http\Requests\Admin\TipoDocumento\DestroyTipoDocumento;
use App\Http\Requests\Admin\TipoDocumento\IndexTipoDocumento;
use App\Http\Requests\Admin\TipoDocumento\StoreTipoDocumento;
use App\Http\Requests\Admin\TipoDocumento\UpdateTipoDocumento;
use App\Models\TipoDocumento;
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

class TipoDocumentoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTipoDocumento $request
     * @return array|Factory|View
     */
    public function index(IndexTipoDocumento $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(TipoDocumento::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['descripcion', 'id', 'status'],

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

        return view('admin.tipo-documento.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.tipo-documento.create');

        return view('admin.tipo-documento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTipoDocumento $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTipoDocumento $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the TipoDocumento
        $tipoDocumento = TipoDocumento::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/tipo-documentos'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/tipo-documentos');
    }

    /**
     * Display the specified resource.
     *
     * @param TipoDocumento $tipoDocumento
     * @throws AuthorizationException
     * @return void
     */
    public function show(TipoDocumento $tipoDocumento)
    {
        $this->authorize('admin.tipo-documento.show', $tipoDocumento);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TipoDocumento $tipoDocumento
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(TipoDocumento $tipoDocumento)
    {
        $this->authorize('admin.tipo-documento.edit', $tipoDocumento);


        return view('admin.tipo-documento.edit', [
            'tipoDocumento' => $tipoDocumento,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTipoDocumento $request
     * @param TipoDocumento $tipoDocumento
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTipoDocumento $request, TipoDocumento $tipoDocumento)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values TipoDocumento
        $tipoDocumento->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/tipo-documentos'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/tipo-documentos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTipoDocumento $request
     * @param TipoDocumento $tipoDocumento
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTipoDocumento $request, TipoDocumento $tipoDocumento)
    {
        $tipoDocumento->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTipoDocumento $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTipoDocumento $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    TipoDocumento::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
