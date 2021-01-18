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

use App\Http\Controllers\DocenciaController;
use App\Role;
use App\Profesor;
use App\Estatus;
use App\Optitulacion;
use App\Plan;
use App\Solicitud;
use App\User;

Route::get('/', function () {
	return view('welcome');
});
#Rutas publicas login
Route::get('/login/alumno','AlumnoController@redirec', function () {
})->name('/login/alumno');

Route::get('/login/profesor', function () {
	return view('profesores.login');
})->name('/login/profesor');

Route::get('/login/administrativo', function () {
	return view('admin.login');
})->name('/login/administrativo');




#Rutas privadas
Auth::routes();

#////////////////////////Alumnos///////////////////////////////////////////////////////



Route::get('/obtenerp','HomeController@obtenerpr', function(){
})->name('/obtenerp')->middleware('auth', 'role:alumno');

Route::post('/confirmarSol','AlumnoController@confirmarS', function(){
})->name('/confirmarSol')->middleware('auth', 'role:alumno');

Route::get('/alumnos','AlumnoController@index', function(){
})->name('/alumnos')->middleware('auth', 'role:alumno');

Route::get('/alumno/imprimir', 'ImprimirController@imprimir', function(){
})->name('imprimir')->middleware('auth','role:alumno');

Route::get('/alumno/imprimir/ver', 'ImprimirController@ver', function(){
})->name('imprimir/ver')->middleware('auth','role:alumno');

Route::get('/alumnos/perfil','AlumnoController@perfil', function () {
	
})->name('/alumnos/perfil')->middleware('auth', 'role:alumno');

Route::get('/alumnos/mensajes', function () {
	return view('alumnos.mensajes');
})->name('/alumnos/mensajes')->middleware('auth', 'role:alumno');

Route::get('/alumnos/solicitud','AlumnoController@obtener', function () {   
})->name('/alumnos/solicitud')->middleware('auth', 'role:alumno');

#generar verificar seguridad que no se genere mas que 1 vez
Route::get('/alumnos/solicitud/generar','AlumnoController@generar', function () {    
})->name('/alumnos/solicitud/generar')->middleware('auth', 'role:alumno');

Route::get('/alumnos/solicitud/editar','AlumnoController@obtenerAL', function () {   
})->name('/alumnos/solicitud/editar')->middleware('auth', 'role:alumno');

Route::post('/alumnos/solicitud/editar/actualizar','AlumnoController@actualizar', function () {   
})->name('/alumnos/solicitud/editar/actualizar')->middleware('auth', 'role:alumno');



Route::post('/alumnos/reg', 'AlumnoController@registrar')->name('/alumnos/reg');

Route::get('/alumnos/solicitud/eliminar','AlumnoController@eliminar', function () {
		
})->name('/alumnos/solicitud/eliminar')->middleware('auth', 'role:alumno');

Route::get('/alumnos/solicitud/eliminar/del','AlumnoController@eliminarS', function () {	
})->name('/alumnos/solicitud/eliminar/del')->middleware('auth', 'role:alumno');;

Route::get('/alumnos/solicitud/estatus','AlumnoController@estatus', function () {

})->name('/alumnos/solicitud/estatus')->middleware('auth', 'role:alumno');


#///////////////////////////PROFESORES///////////////////////////////////////////////////
Route::get('/profesor', function () {
	return view('profesores.index');
})->middleware('auth', 'role:profesor');
Route::get('/profesor/perfil', function () {
	return view('profesores.perfil');
})->name('/profesor/perfil')->middleware('auth', 'role:profesor');

Route::get('/profesor/mensajes', function () {
	return view('profesores.index');
})->name('/profesor/mensajes')->middleware('auth', 'role:profesor');

Route::get('/profesor/alumnos/asignados','ProfesorController@asignados', function () {
	
})->name('/profesor/alumnos/asignados')->middleware('auth', 'role:profesor');

Route::post('/profesor/alumnos/asignados/actualizar','ProfesorController@actualizar_solicitud', function () {
	
})->name('/profesor/alumnos/asignados/actualizar')->middleware('auth', 'role:profesor');

Route::get('/profesor/alumnos/asignados/detalle/{id}','ProfesorController@alumnoD', function () {
	
})->name('alumnoDetalle')->middleware('auth', 'role:profesor');

Route::get('/storage/{archivo}', function ($archivo) {
     $public_path = public_path();
     $url = $public_path.'/storage/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::exists($archivo))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);

})->name('storage');

Route::get('/profesor/alumnos/eventos','ProfesorController@ceremonias', function () {
	
})->name('/profesor/alumnos/eventos')->middleware('auth', 'role:profesor');

#//////////////////////JEFE DOCENCIA///////////////////////////////////////////////////
Route::get('/docencia','DocenciaController@obtener', function () {
	
})->name('/docencia')->middleware('auth', 'role:docencia');

Route::get('/docencia/perfil', function () {
	return view('docencia.perfil');
})->name('/docencia/perfil')->middleware('auth', 'role:docencia');

Route::get('/storage/{$file}', function($file){
	$public_path = public_path();
     $url = $public_path.'/storage/'.$file;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::exists($file))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);


})->middleware('auth', 'role:docencia')->name('descargar_archivo');

//Docencia ALUMNOS
Route::get('/docencia/alumnos/solicitudes','DocenciaController@obtener_solicitudes', function () {
	
})->name('/docencia/alumnos/solicitudes')->middleware('auth', 'role:docencia');

Route::get('/docencia/alumnos/solicitudes/detalle/{id}','DocenciaController@detalle_solicitud', function () {
	
})->name('solicitudDetalle')->middleware('auth', 'role:docencia');

Route::post('/docencia/alumnos/solicitudes/actualizar','DocenciaController@actualizar_solicitud', function () {   
})->name('/docencia/alumnos/solicitudes/actualizar')->middleware('auth', 'role:docencia');

//Docencia CARRERAS
Route::get('/docencia/carreras/agregar', function () {
	return view('docencia.carreras_agregar');
})->name('/docencia/carreras/agregar')->middleware('auth', 'role:docencia');

Route::post('/docencia/carreras/agregar/nueva','DocenciaController@agregar_carrera', function () {
	
})->name('/docencia/carreras/agregar/nueva')->middleware('auth', 'role:docencia');

Route::get('/docencia/carreras/modificar','DocenciaController@obtener_carreras', function () {
	
})->name('/docencia/carreras/modificar')->middleware('auth', 'role:docencia');

Route::post('/docencia/carreras/modificar/actualizar','DocenciaController@actualizar_carrera', function () {
	
})->name('/docencia/carreras/modificar/actualizar')->middleware('auth', 'role:docencia');

//Docencia PLANES
Route::get('/docencia/planes/agregar', function () {
	return view('docencia.planes_agregar');
})->name('/docencia/planes/agregar')->middleware('auth', 'role:docencia');

Route::post('/docencia/planes/agregar/nuevo','DocenciaController@agregar_planes', function () {
	
})->name('/docencia/planes/agregar/nuevo')->middleware('auth', 'role:docencia');

Route::get('/docencia/planes/modificar','DocenciaController@obtener_planes', function () {
	
})->name('/docencia/planes/modificar')->middleware('auth', 'role:docencia');

Route::post('/docencia/planes/modificar/actualizar','DocenciaController@actualizar_planes', function () {
	
})->name('/docencia/planes/modificar/actualizar')->middleware('auth', 'role:docencia');

//Docencia PROFESORES

Route::get('/docencia/profesores/agregar', function () {
	return view('docencia.profesores_agregar');
})->name('/docencia/profesores/agregar')->middleware('auth', 'role:docencia');

Route::post('/docencia/profesores/agregar/nuevo','DocenciaController@agregar_profesores' ,function () {
	
})->name('/docencia/profesores/agregar/nuevo')->middleware('auth', 'role:docencia');

Route::get('/docencia/profesores/modificar','DocenciaController@obtener_profesores' ,function () {
	/*$plan=Plan::all();
	$titulacion=Optitulacion::all();
	$profesores=Profesor::all();
	return view('docencia.profesores',compact('profesores','plan','titulacion'));*/
})->name('/docencia/profesores/modificar')->middleware('auth', 'role:docencia');

Route::post('/docencia/profesores/modificar/actualizar','DocenciaController@actualizar_profesores' ,function () {
	
})->name('/docencia/profesores/modificar/actualizar')->middleware('auth', 'role:docencia');

Route::get('/docencia/profesores/solicitudes/revisores','DocenciaController@obtener_revisores', function () {
	
})->name('/docencia/profesores/solicitudes/revisores')->middleware('auth', 'role:docencia');

Route::get('/docencia/profesores/solicitudes/sinodales','DocenciaController@obtener_sinodales', function () {
	
})->name('/docencia/profesores/solicitudes/sinodales')->middleware('auth', 'role:docencia');

//Docencia CORREO
Route::get('/docencia/correo','DocenciaController@obtener', function () {
	
})->name('/docencia/correo')->middleware('auth', 'role:docencia');

Route::get('/docencia/correo/mensajes','DocenciaController@obtener', function () {
	
})->name('/docencia/correo/mensajes')->middleware('auth', 'role:docencia'); 

///////////////Docencia CONTROL DE USUARIOS
Route::get('/docencia/control/usuarios', function () {
	$roles= Role::whereIn('name', ['servicio','docencia','coordinacion_t','d_estudios_p','d_academico','coordinacion_s_e'])->get();
    
    return view('docencia.controlUsuarios_agregar',compact('roles'));
   
})->name('/docencia/control/usuarios')->middleware('auth', 'role:docencia');

Route::post('/docencia/control/usuarios/nuevo','DocenciaController@agregar_usuario_rol', function () { 

})->name('/docencia/control/usuarios/nuevo')->middleware('auth', 'role:docencia');

Route::get('/docencia/control/usuarios/modificar', function () {
	$roles= Role::whereIn('name', ['servicio','docencia','coordinacion_t','d_estudios_p','d_academico','coordinacion_s_e'])->get();
	$usuarios= \DB::table('users')->join('role_user','users.id','=','role_user.user_id')->get();
	//dd($usuarios);
	return view('docencia.controlUsuarios',compact('roles','usuarios'));
})->name('/docencia/control/usuarios/modificar')->middleware('auth', 'role:docencia');

Route::post('/docencia/control/usuarios/modificar/actualizar','DocenciaController@actualizar_usuario_rol', function () { 

})->name('/docencia/control/usuarios/modificar/actualizar')->middleware('auth', 'role:docencia');

Route::get('/docencia/control/usuarios/modificar/actualizar/{id}','DocenciaController@eliminar_usuario_rol', function () {
	
})->name('alumnoDel')->middleware('auth', 'role:docencia');

Route::get('/docencia/resumen','DocenciaController@resumen', function () {
	
})->name('/docencia/resumen')->middleware('auth', 'role:docencia');

//   Servicio Social  //

Route::get('/docencia/ss','ServicioController@index', function () {
})->name('/ss')->middleware('auth', 'role:servicio');
Route::get('/docencia/ss/perfil', function () {
	return view('servicio.perfil');
})->name('/docencia/ss/perfil')->middleware('auth', 'role:docencia');

Route::get('/docencia/ss/solicitudes','ServicioController@obtener_solicitudes', function () {
})->name('/docencia/ss/solicitudes')->middleware('auth', 'role:servicio');

Route::get('/docencia/ss/solicitudes/detalle/{id}','ServicioController@detalle_solicitud', function () {	
})->name('detalleSS')->middleware('auth', 'role:servicio');

Route::get('/docencia/ss/profesores/revisores','ServicioController@obtener_revisores', function () {
})->name('/docencia/ss/profesores/revisores')->middleware('auth', 'role:servicio');

Route::get('/docencia/ss/profesores/sinodales','ServicioController@obtener_sinodales', function () {
})->name('/docencia/ss/profesores/sinodales')->middleware('auth', 'role:servicio');

Route::post('/docencia/ss/solicitudes/actualizar','ServicioController@actualizar_solicitud', function () {   
})->name('/docencia/ss/solicitudes/actualizar')->middleware('auth', 'role:servicio');






Route::get('/home', 'HomeController@index')->name('home');
