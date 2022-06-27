<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Concepto\BulkDestroyConcepto;
use App\Http\Requests\Admin\Concepto\DestroyConcepto;
use App\Http\Requests\Admin\Concepto\IndexConcepto;
use App\Http\Requests\Admin\Concepto\StoreConcepto;
use App\Http\Requests\Admin\Concepto\UpdateConcepto;
use App\Models\Concepto;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ConceptoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexConcepto $request
     * @return array|Factory|View
     */
    public function index(IndexConcepto $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Concepto::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['descripcion', 'grado_id', 'id', 'valor'],

            // set columns to searchIn
            ['descripcion', 'grado_id', 'id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.concepto.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.concepto.create');

        return view('admin.concepto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreConcepto $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreConcepto $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Concepto
        $concepto = Concepto::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/conceptos'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/conceptos');
    }

    /**
     * Display the specified resource.
     *
     * @param Concepto $concepto
     * @throws AuthorizationException
     * @return void
     */
    public function show(Concepto $concepto)
    {
        $this->authorize('admin.concepto.show', $concepto);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Concepto $concepto
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Concepto $concepto)
    {
        $this->authorize('admin.concepto.edit', $concepto);


        return view('admin.concepto.edit', [
            'concepto' => $concepto,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateConcepto $request
     * @param Concepto $concepto
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateConcepto $request, Concepto $concepto)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Concepto
        $concepto->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/conceptos'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/conceptos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyConcepto $request
     * @param Concepto $concepto
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyConcepto $request, Concepto $concepto)
    {
        $concepto->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyConcepto $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyConcepto $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Concepto::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function buscarConcepto($data,$request){

        $grado_id = $data[0]->matricula_grado_id;
        $descripcion = $request->get('concepto');
        $parametros = ("exists (SELECT value FROM STRING_SPLIT(grupo_grado_id, ',') where [value] = '$grado_id')");//"find_in_set('$grado_id',grupo_grado_id)";

        //$result = Concepto::where("descripcion", $descripcion)->whereRaw($parametros)->get();
        $result = DB::table('concepto')
                        ->select(
                            'id'
                            ,'descripcion'
                            ,'valor')
                        ->where([["concepto.descripcion",'LIKE',"%$descripcion%"]])
                        ->whereRaw($parametros)
                        ->get();

        return $result;
    }
}
