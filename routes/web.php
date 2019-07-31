<?php

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

/*
 * Rutas de los controladores de la pagina principal
 */
Route::get('/','indexController@home');
Route::get('/contacto','indexController@contacto');
Route::get('/pruebas','indexController@pruebas');
Route::get('/inscripcion_abierta','indexController@inscripcionAbierta');
Route::get('/pruebas/{prueba}','indexController@cargarPruebas');
Route::get('/inscribirse/{prueba}','usuariosController@showInscripcion');
Route::get('/cargarclubes/{club}','usuariosController@cargarClubes');// Se encarga de listar los clubes por AJAX en el formulario de las inscripciones
Route::get('/pagar/{prueba}', ['as' => 'redsys', 'uses' => 'RedsysController@index']);// Ruta para la pasarela de pagos
Route::post('/pagar/{prueba}', ['as' => 'redsys', 'uses' => 'RedsysController@index']);// Ruta para la pasarela de pagos
Route::get('/pago/{inscrito}', ['as' => 'redsys', 'uses' => 'RedsysController@pagoAtrasado']);// Ruta para la gente que no ha pagado al inscribirse
Route::get('/cargarInscritos/{param}/{filtro}/{id_prueba}','usuariosController@cargarInscritos'); // Filtro de usuarios pruebas
Route::post('/redsys/notification','RedsysController@comprobar');// comprueba que todo esta bien
Route::get('/redsys/notification','RedsysController@comprobar');// comprueba que todo esta bien


/*
 * Rutas del los controladores del panel de administracion/panel de usuarios
 */

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/panel_usuario','usuariosController@index');// Acceso al panel de usuarios
    Route::get('/perfil','usuariosController@perfil'); //Perfil de usuarios (DATOS)
    Route::get('/mispruebas','usuariosController@misPruebas');//Perfil de usuarios (PRUEBAS INSCRITO)
    Route::get('/pagos_pendiente','usuariosController@pagosPendientes'); //Perfil de usuarios(PAGOS PENDIENTES)
    Route::get('/resultados','usuariosController@resultados');// Perfil de usuarios(RESULTADOS)
    Route::get('/cerrar_sesion','Auth\LoginController@logout'); // Logout para los usuarios normales
    // Rutas para las acciones de los clubes
    Route::get('/panel_club','clubController@index'); // Ruta que te lleva a la seccion principal
    Route::post('/registro_usuario','clubController@registrarUsuario'); //Ruta para registrar usuarios de tu club
    Route::post('inscripcionMultiple','clubController@inscripcionMultiple'); //Ruta para la inscripciones multiples de los clubes
    Route::get('/usrClub/{usuario}','clubController@cargarUsuario'); //Se encarga de cargar las datos de los usuarios de un club
    Route::post('/editarUsrClub/{id}','clubController@editarUsrClub'); // Ruta para la edición de usuarios de un club
    Route::post('/eliminarUsrClub/{id}','clubController@eliminarUsrClub'); // Ruta para eliminar usuarios de un club
    // Rutas para las acciones de administrador
    Route::group(['middleware' => 'role'], function(){
        Route::get('/admin', 'adminController@index');// Acceso al pandel de administrador
        Route::get('/nueva_prueba', 'adminController@showPrueba');// Muestra el formulario para crear una prueba
        Route::post('/nueva_prueba','adminController@createPrueba');// Crea la nueva prueba
        Route::post('/editar_prueba','adminController@showEditar');// Esta ruta redirige al formulario de edición y carga los datos
        Route::post('/update_prueba/{prueba}','adminController@editPrueba');// Formulario de edición
        Route::post('/eliminar_prueba','adminController@deletePrueba');// Borra las pruebas
        Route::get('/delete_plazo/{plazo}','adminController@deletePlazos');// Ruta para borrar los plazos
        Route::get('/cargar_plazos/{prueba}/{cantidad}','adminController@crearPlazos'); //Ruta para crear por AJAX , los plazos para una prueba que ya existe
        Route::get('/update_plazos/{prueba}/{fecha}/{precio}','adminController@actualizarPlazos');//Se encarga de actualizar los plazos mediante AJAX
    });
});



