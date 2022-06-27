<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Me\BulkDestroyMe;
use App\Http\Requests\Admin\Me\DestroyMe;
use App\Http\Requests\Admin\Me\IndexMe;
use App\Http\Requests\Admin\Me\StoreMe;
use App\Http\Requests\Admin\Me\UpdateMe;
use App\Models\Me;
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

class MesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMe $request
     * @return array|Factory|View
     */
    public function index(IndexMe $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Me::class)->processRequestAndGet(
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

        return view('admin.me.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.me.create');

        return view('admin.me.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMe $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMe $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Me
        $me = Me::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/mes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/mes');
    }

    /**
     * Display the specified resource.
     *
     * @param Me $me
     * @throws AuthorizationException
     * @return void
     */
    public function show(Me $me)
    {
        $this->authorize('admin.me.show', $me);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Me $me
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Me $me)
    {
        $this->authorize('admin.me.edit', $me);


        return view('admin.me.edit', [
            'me' => $me,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMe $request
     * @param Me $me
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMe $request, Me $me)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Me
        $me->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/mes'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/mes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMe $request
     * @param Me $me
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMe $request, Me $me)
    {
        $me->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMe $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMe $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Me::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
