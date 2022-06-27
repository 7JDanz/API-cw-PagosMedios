<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Persona\BulkDestroyPersona;
use App\Http\Requests\Admin\Persona\DestroyPersona;
use App\Http\Requests\Admin\Persona\IndexPersona;
use App\Http\Requests\Admin\Persona\StorePersona;
use App\Http\Requests\Admin\Persona\UpdatePersona;
use App\Models\Persona;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PersonaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPersona $request
     * @return array|Factory|View
     */
    public function index(IndexPersona $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Persona::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['apellidos', 'direccion', 'email', 'id', 'identificacion', 'nombres', 'representante_persona_id', 'status', 'telefono', 'tipo_documento_id'],

            // set columns to searchIn
            ['apellidos', 'direccion', 'email', 'id', 'identificacion', 'nombres', 'representante_persona_id', 'telefono']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.persona.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.persona.create');

        return view('admin.persona.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePersona $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePersona $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Persona
        $persona = Persona::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/personas'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/personas');
    }

    /**
     * Create a new Persona
     */
    public function save ($request){
        // Store the Persona
        $request = new Request($request);

        $persona = Persona::create($request->all());
        $id = DB::table('persona')->where("identificacion", $request->identificacion)->first()->id;

        return $id;

    }

    /**
     * Display the specified resource.
     *
     * @param Persona $persona
     * @throws AuthorizationException
     * @return void
     */
    public function show(Persona $persona)
    {
        $this->authorize('admin.persona.show', $persona);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Persona $persona
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Persona $persona)
    {
        $this->authorize('admin.persona.edit', $persona);


        return view('admin.persona.edit', [
            'persona' => $persona,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePersona $request
     * @param Persona $persona
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePersona $request, Persona $persona)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Persona
        $persona->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/personas'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/personas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyPersona $request
     * @param Persona $persona
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyPersona $request, Persona $persona)
    {
        $persona->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyPersona $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyPersona $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Persona::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
