<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Matricula\BulkDestroyMatricula;
use App\Http\Requests\Admin\Matricula\DestroyMatricula;
use App\Http\Requests\Admin\Matricula\IndexMatricula;
use App\Http\Requests\Admin\Matricula\StoreMatricula;
use App\Http\Requests\Admin\Matricula\UpdateMatricula;
use App\Models\Matricula;
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

class MatriculaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMatricula $request
     * @return array|Factory|View
     */
    public function index(IndexMatricula $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Matricula::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['fecha_fin', 'fecha_inicio', 'grado_id', 'id', 'persona_id', 'status'],

            // set columns to searchIn
            ['grado_id', 'id', 'persona_id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.matricula.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.matricula.create');

        return view('admin.matricula.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMatricula $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMatricula $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Matricula
        $matricula = Matricula::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/matriculas'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/matriculas');
    }

    /***
     * Crea Matricula
     *
     */
    public function save ($request){
        $request = new Request($request);

        $matricula = Matricula::create($request->all());

        $id = DB::table('matricula')->where([
            ["grado_id",'=',$request->grado_id],
            ["persona_id",'=',$request->persona_id],
            ["status",'=',1]
        ])->get();
        return $id;
    }
    /**
     * Display the specified resource.
     *
     * @param Matricula $matricula
     * @throws AuthorizationException
     * @return void
     */
    public function show(Matricula $matricula)
    {
        $this->authorize('admin.matricula.show', $matricula);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Matricula $matricula
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Matricula $matricula)
    {
        $this->authorize('admin.matricula.edit', $matricula);


        return view('admin.matricula.edit', [
            'matricula' => $matricula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMatricula $request
     * @param Matricula $matricula
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMatricula $request, Matricula $matricula)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Matricula
        $matricula->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/matriculas'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/matriculas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMatricula $request
     * @param Matricula $matricula
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMatricula $request, Matricula $matricula)
    {
        $matricula->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMatricula $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMatricula $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Matricula::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
