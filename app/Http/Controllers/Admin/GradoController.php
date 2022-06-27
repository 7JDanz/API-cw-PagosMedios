<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Grado\BulkDestroyGrado;
use App\Http\Requests\Admin\Grado\DestroyGrado;
use App\Http\Requests\Admin\Grado\IndexGrado;
use App\Http\Requests\Admin\Grado\StoreGrado;
use App\Http\Requests\Admin\Grado\UpdateGrado;
use App\Models\Grado;
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

class GradoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexGrado $request
     * @return array|Factory|View
     */
    public function index(IndexGrado $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Grado::class)->processRequestAndGet(
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

        return view('admin.grado.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.grado.create');

        return view('admin.grado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGrado $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreGrado $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Grado
        $grado = Grado::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/grados'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/grados');
    }

    /**
     * Display the specified resource.
     *
     * @param Grado $grado
     * @throws AuthorizationException
     * @return void
     */
    public function show(Grado $grado)
    {
        $this->authorize('admin.grado.show', $grado);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Grado $grado
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Grado $grado)
    {
        $this->authorize('admin.grado.edit', $grado);


        return view('admin.grado.edit', [
            'grado' => $grado,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGrado $request
     * @param Grado $grado
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateGrado $request, Grado $grado)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Grado
        $grado->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/grados'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/grados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyGrado $request
     * @param Grado $grado
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyGrado $request, Grado $grado)
    {
        $grado->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyGrado $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyGrado $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Grado::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
