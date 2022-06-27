<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Descuento\BulkDestroyDescuento;
use App\Http\Requests\Admin\Descuento\DestroyDescuento;
use App\Http\Requests\Admin\Descuento\IndexDescuento;
use App\Http\Requests\Admin\Descuento\StoreDescuento;
use App\Http\Requests\Admin\Descuento\UpdateDescuento;
use App\Models\Descuento;
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
use Carbon\Carbon;
use Carbon\Factory as CarbonFactory;

class DescuentoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexDescuento $request
     * @return array|Factory|View
     */
    public function index(IndexDescuento $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Descuento::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['descripcion', 'grado_id', 'id', 'max', 'min', 'status', 'valor'],

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

        return view('admin.descuento.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.descuento.create');

        return view('admin.descuento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDescuento $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreDescuento $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Descuento
        $descuento = Descuento::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/descuentos'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/descuentos');
    }

    /**
     * Display the specified resource.
     *
     * @param Descuento $descuento
     * @throws AuthorizationException
     * @return void
     */
    public function show(Descuento $descuento)
    {
        $this->authorize('admin.descuento.show', $descuento);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Descuento $descuento
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Descuento $descuento)
    {
        $this->authorize('admin.descuento.edit', $descuento);


        return view('admin.descuento.edit', [
            'descuento' => $descuento,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDescuento $request
     * @param Descuento $descuento
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateDescuento $request, Descuento $descuento)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Descuento
        $descuento->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/descuentos'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/descuentos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyDescuento $request
     * @param Descuento $descuento
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyDescuento $request, Descuento $descuento)
    {
        $descuento->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyDescuento $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyDescuento $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Descuento::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function buscarDescuento($data,$request){
        $dt = Carbon::parse($request->ShootDateTime)->timezone('America/Guayaquil');

        $descripcion = $request->get('concepto');
        $filtro = $data[0]->matricula_grado_id;
        $mes_escogido =(int)$request->get('mes');
        //$mes_actual = $dt->month;

        if($dt->month>$mes_escogido)       $dia = 30;
        elseif($dt->month==$mes_escogido)   $dia = $dt->day;
        elseif($dt->month<$mes_escogido)   $dia = 1;
        //DB::enableQueryLog();
        $buscar = DB::table('concepto_descuento')
                        ->select(
                                'concepto_descuento.id as id',
                                'concepto.valor as valor_pension',
                                'descuento.valor as valor_descuento',
                                DB::raw('concepto.valor - descuento.valor as total'),
                                'descuento.descripcion')
                        ->join('concepto','concepto_descuento.concepto_id','=','concepto.id')
                        ->join('descuento','concepto_descuento.descuento_id','=','descuento.id')
                        ->where([
                            ["concepto.descripcion",'LIKE',"%$descripcion%"],
                            ["concepto_descuento.status",'=',1]
                        ])
                        ->whereRaw("exists(select value from STRING_SPLIT(concepto.grupo_grado_id,',') where [value] = '$filtro')")//( "find_in_set('$filtro',concepto.grupo_grado_id)")
                        ->whereRaw("exists(select value from STRING_SPLIT(descuento.grupo_grado_id,',') where [value] = '$filtro')")//( "find_in_set('$filtro',descuento.grupo_grado_id)")
                        ->whereRaw("(descuento.min <= ? AND descuento.max >= ?) ", [$dia,$dia])
                        ->get();

        //dd(DB::getQueryLog(),$buscar);
        return $buscar;
    }
}
