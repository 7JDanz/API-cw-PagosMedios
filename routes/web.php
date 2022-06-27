<?php

use App\Http\Controllers\BuscarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('buscar/persona',                                          'BuscarController@busqueda');
Route::post('redirigir/pago',                                            'PagosMediosController@postCreatePayment');


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('modulos')->name('modulos/')->group(static function() {
            Route::get('/',                                             'ModuloController@index')->name('index');
            Route::get('/create',                                       'ModuloController@create')->name('create');
            Route::post('/',                                            'ModuloController@store')->name('store');
            Route::get('/{modulo}/edit',                                'ModuloController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ModuloController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{modulo}',                                    'ModuloController@update')->name('update');
            Route::delete('/{modulo}',                                  'ModuloController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('statuses')->name('statuses/')->group(static function() {
            Route::get('/',                                             'StatusController@index')->name('index');
            Route::get('/create',                                       'StatusController@create')->name('create');
            Route::post('/',                                            'StatusController@store')->name('store');
            Route::get('/{status}/edit',                                'StatusController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'StatusController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{status}',                                    'StatusController@update')->name('update');
            Route::delete('/{status}',                                  'StatusController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('tipo-documentos')->name('tipo-documentos/')->group(static function() {
            Route::get('/',                                             'TipoDocumentoController@index')->name('index');
            Route::get('/create',                                       'TipoDocumentoController@create')->name('create');
            Route::post('/',                                            'TipoDocumentoController@store')->name('store');
            Route::get('/{tipoDocumento}/edit',                         'TipoDocumentoController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TipoDocumentoController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{tipoDocumento}',                             'TipoDocumentoController@update')->name('update');
            Route::delete('/{tipoDocumento}',                           'TipoDocumentoController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('grados')->name('grados/')->group(static function() {
            Route::get('/',                                             'GradoController@index')->name('index');
            Route::get('/create',                                       'GradoController@create')->name('create');
            Route::post('/',                                            'GradoController@store')->name('store');
            Route::get('/{grado}/edit',                                 'GradoController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'GradoController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{grado}',                                     'GradoController@update')->name('update');
            Route::delete('/{grado}',                                   'GradoController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('personas')->name('personas/')->group(static function() {
            Route::get('/',                                             'PersonaController@index')->name('index');
            Route::get('/create',                                       'PersonaController@create')->name('create');
            Route::post('/',                                            'PersonaController@store')->name('store');
            Route::get('/{persona}/edit',                               'PersonaController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PersonaController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{persona}',                                   'PersonaController@update')->name('update');
            Route::delete('/{persona}',                                 'PersonaController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('conceptos')->name('conceptos/')->group(static function() {
            Route::get('/',                                             'ConceptoController@index')->name('index');
            Route::get('/create',                                       'ConceptoController@create')->name('create');
            Route::post('/',                                            'ConceptoController@store')->name('store');
            Route::get('/{concepto}/edit',                              'ConceptoController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ConceptoController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{concepto}',                                  'ConceptoController@update')->name('update');
            Route::delete('/{concepto}',                                'ConceptoController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('descuentos')->name('descuentos/')->group(static function() {
            Route::get('/',                                             'DescuentoController@index')->name('index');
            Route::get('/create',                                       'DescuentoController@create')->name('create');
            Route::post('/',                                            'DescuentoController@store')->name('store');
            Route::get('/{descuento}/edit',                             'DescuentoController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DescuentoController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{descuento}',                                 'DescuentoController@update')->name('update');
            Route::delete('/{descuento}',                               'DescuentoController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('matriculas')->name('matriculas/')->group(static function() {
            Route::get('/',                                             'MatriculaController@index')->name('index');
            Route::get('/create',                                       'MatriculaController@create')->name('create');
            Route::post('/',                                            'MatriculaController@store')->name('store');
            Route::get('/{matricula}/edit',                             'MatriculaController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'MatriculaController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{matricula}',                                 'MatriculaController@update')->name('update');
            Route::delete('/{matricula}',                               'MatriculaController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('mes')->name('mes/')->group(static function() {
            Route::get('/',                                             'MesController@index')->name('index');
            Route::get('/create',                                       'MesController@create')->name('create');
            Route::post('/',                                            'MesController@store')->name('store');
            Route::get('/{me}/edit',                                    'MesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'MesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{me}',                                        'MesController@update')->name('update');
            Route::delete('/{me}',                                      'MesController@destroy')->name('destroy');
        });
    });
});
