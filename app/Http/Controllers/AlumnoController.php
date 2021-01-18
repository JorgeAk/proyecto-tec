<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\DB;
use DB;
use Carbon\Carbon;
use Session;
use App\Role;
use App\User;
use App\Profesor;
use App\Estatus;
use App\Optitulacion;
use App\Plan;
use App\Solicitud;
use App\Carrera;
use App\Ceremonia;
use App\Revisor;
use App\Sinodal;

class AlumnoController extends Controller
{
    public function index()
    {
        //$usr=auth()->user()->email;
        //$alumno = \DB::table('alumnos')->where('p_correo','=',"$usr")->get();
        //$request->user()->authorizeRoles('user');
        return view('alumnos.index');
    }

    public function perfil()
    {
        
        return view('alumnos.perfil');

        
    }

    public function generar()
    {
        $usr             = auth()->user()->email;
        $planes          = Plan::all();
        $op_titulaciones = Optitulacion::all();
        $profesores      = Profesor::all();
        $generar         = Solicitud::where('p_correo',"$usr")->get();
        
        if ($generar->isEmpty()) {
            return view('alumnos.generar', compact('planes','op_titulaciones','profesores'));
        }else{
            $solicitud = \DB::table('solicitudes')->where('p_correo', '=', "$usr")->get();
            return view('alumnos.solicitud', compact('solicitud'));
        }

        
    }

    public function redirec()
    {
        if (Auth::check()) {
            //return view('alumnos.index');
            return redirect()->guest('/alumnos');
        }
        return view('alumnos.login');
    }

    public function registrar(Request $request)
    {
        $numero_control  =  $request->input('n_control');
        $primer_nombre   =  strtoupper($request->input('p_nombre'));
        $segundo_nombre  =  strtoupper($request->input('s_nombre'));
        $a_paterno       =  strtoupper($request->input('a_paterno'));
        $a_materno       =  strtoupper($request->input('a_materno'));
        $municipio       =  strtoupper($request->input('municipio'));
        $cp              =  $request->input('cp');
        $entidad_f       =  $request->input('entidad_f');
        $telefono        =  $request->input('telefono');
        $celular         =  $request->input('celular');
        $p_correo        =  auth()->user()->email;
        $s_correo        =  $request->input('s_correo');
        $carrera         =  $request->input('carrera');
        $plan            =  $request->input('plan');
        $f_ingreso       =  $request->input('f_ingreso');
        $f_egreso        =  $request->input('f_egreso');
        $op_titulacion   =  $request->input('op_titulacion');
        $n_proyecto      =  strtoupper($request->input('n_proyecto'));
        $asesor          =  $request->input('asesor');
        $presidente      =  $request->input('presidente');
        $secretario      =  $request->input('secretario');
        $v_propietario   =  $request->input('v_propietario');
        $v_suplente      =  $request->input('v_suplente');

        $slug            = uniqid(); 
        
        $sin_revisor   = 0;
        $sin_sinodal   = 0;  
        $sin_asesor    = 0;
        $sin_nproyecto = "";
        $sin_p_archivo = "";
        $fecha_actual  = Carbon::now();
        $s_estatus     = 1;

        //CARGA DE ARCHIVO
        if($request->hasFile('proy_archivo') ){ 

            $file = $request->file('proy_archivo')->store('public');
            $pro_archivo = str_replace("public/", "", $file);
 
         }else{
 
             $pro_archivo  = "";
 
         }


        if ($op_titulacion == 4) {
            //Registro de la solicitud
            $datos = new Solicitud(array(
                'n_control'       => $numero_control,
                'p_nombre'        => $primer_nombre,
                's_nombre'        => $segundo_nombre,
                'a_paterno'       => $a_paterno,
                'a_materno'       => $a_materno,
                'municipio'       => $municipio,
                'cp'              => $cp,
                'entidad_f'       => $entidad_f,
                'telefono'        => $telefono,
                'celular'         => $celular,
                'p_correo'        => $p_correo,
                's_correo'        => $s_correo,
                'carrera'         => $carrera,
                'plan'            => $plan,
                'f_ingreso'       => $f_ingreso,
                'f_egreso'        => $f_egreso,
                'op_titulacion'   => $op_titulacion,
                'n_proyecto'      => $sin_nproyecto,
                'asesor'          => $sin_asesor,
                'presidente'      => $presidente,
                'secretario'      => $secretario,
                'v_propietario'   => $v_propietario,
                'v_suplente'      => $v_suplente,
                'primer_revisor'  => $sin_revisor,
                'segundo_revisor' => $sin_revisor,
                'tercer_revisor'  => $sin_revisor,
                'cuarto_revisor'  => $sin_revisor,
                's_estatus'       => $s_estatus,
                'proy_archivo'    => $pro_archivo
            ));

            $datos->save();

        } else {

            $datos = new Solicitud(array(
                'n_control'       => $numero_control,
                'p_nombre'        => $primer_nombre,
                's_nombre'        => $segundo_nombre,
                'a_paterno'       => $a_paterno,
                'a_materno'       => $a_materno,
                'municipio'       => $municipio,
                'cp'              => $cp,
                'entidad_f'       => $entidad_f,
                'telefono'        => $telefono,
                'celular'         => $celular,
                'p_correo'        => $p_correo,
                's_correo'        => $s_correo,
                'carrera'         => $carrera,
                'plan'            => $plan,
                'f_ingreso'       => $f_ingreso,
                'f_egreso'        => $f_egreso,
                'op_titulacion'   => $op_titulacion,
                'n_proyecto'      => $n_proyecto,
                'asesor'          => $asesor,
                'presidente'      => $sin_sinodal,
                'secretario'      => $sin_sinodal,
                'v_propietario'   => $sin_sinodal,
                'v_suplente'      => $sin_sinodal,
                'primer_revisor'  => $sin_revisor,
                'segundo_revisor' => $sin_revisor,
                'tercer_revisor'  => $sin_revisor,
                'cuarto_revisor'  => $sin_revisor,
                's_estatus'       => $s_estatus,
                'proy_archivo'    => $pro_archivo
            ));

            $datos->save();
        }

        Session::flash('message', 'Solicitud Generada');
        return view('alumnos.index');
        

    }

    public function obtener()
    {
        //* SE ACTUALIZO

        $usr       = auth()->user()->email;
        $solicitud = Solicitud::where('p_correo',"$usr")->get();
        $planes    = Plan::all();
        
        $op_titulaciones = Optitulacion::all();
    
        $sinodales  = array();
        $revisores  = array();
        $profesores = Profesor::all();
        
        foreach ($solicitud as $sol) {
            if ($sol->presidente != 0 and $sol->secretario != 0 and $sol->v_propietario != 0 and $sol->v_suplente != 0) {
                $sinodales = Profesor::all();
            } else {
                if ($sol->primer_revisor != 0 and $sol->segundo_revisor != 0 and $sol->tercer_revisor != 0 and $sol->cuarto_revisor != 0) {
                    $revisores = Profesor::all();
                }
            }
        }

        return view('alumnos.solicitud', compact('solicitud', 'planes', 'op_titulaciones', 'sinodales', 'revisores','profesores')); 
    }

    public function obtenerAL()
    {
        //* SE ACTUALIZO
        $usr             = auth()->user()->email;
        $solicitud       = Solicitud::where('p_correo',"$usr")->get();
        $planes          = Plan::all();
        $op_titulaciones = Optitulacion::all();
        $profesores      = Profesor::all();
        return view('alumnos.editar', compact('solicitud', 'planes', 'op_titulaciones','profesores'));
    }

    public function actualizar(Request $request){
        //* SE ACTUALIZO

        //Para Actualizar datos de la solicitud
        $usr        = auth()->user()->email;
        $mi_id      = Solicitud::where('p_correo',"$usr")->first('proy_archivo');
        $op_titulacion   =  $request->input('op_titulacion');
        $limpiar =0;

        //ACTUALIZANDO IMAGEN SI VIENE CON CONTENIDO
        if($request->hasFile('input_file') ){
            $file = $request->file('input_file');
            //si el archivo existe que sea eliminado antes de registrar otro
            if(Storage::exists('public/'.$mi_id->proy_archivo)) {
                Storage::delete('public/'.$mi_id->proy_archivo);
            }
            //indicamos que queremos guardar un nuevo archivo en el disco local
            $file = $request->file('input_file')->store('public');
            $pro_archivo = str_replace("public/", "", $file);
 
         //si no se cambia el archivo, se deja la que tenia
         }else{
            $pro_archivo= $mi_id->proy_archivo;
         }

         if (!empty($_POST)) {
            $i = 1;

            if($op_titulacion =! 4){
                 Solicitud::where('p_correo', "$usr")->update(['presidente'=>"$limpiar",'secretario'=>"$limpiar",'v_propietario'=>"$limpiar",'v_suplente'=>"$limpiar"]);
            }
            foreach ($_POST as $key => $value) {
                if (trim($value) != '') {
                    $sqlArr[$key] = "$value";
                }
            }
            unset($sqlArr['_token']);
            
            $usuario = Solicitud::where('p_correo', '=', "$usr")->update($sqlArr);
            $usuario = Solicitud::where('p_correo', "$usr")->update(['proy_archivo'=>"$pro_archivo"]);
            
            Session::flash('message', 'Solicitud Actualizada');
             
        }
        

        return view('alumnos.index');
    }


    public function estatus()
    {
        //* SE ACTUALIZO
        $usr     = auth()->user()->email;
        $estatus = Solicitud::where('p_correo',"$usr")->get();
        
        return view('alumnos.estatus', compact('estatus'));
    }

    public function confirmarS(Request $request)
    {
        //* SE ACTUALIZO
        $usr      = auth()->user()->email;
        $confirma = $request->input('confirm_sol');
        if($confirma=='SI'){
            $actualiza = Solicitud::where('p_correo',"$usr")->update(['s_estatus' => 2]);
            Session::flash('message', 'Solicitud Enviada con exito');
        }

        return view('alumnos.index');
        
    }

    public function eliminar()
    {
        //* SE ACTUALIZO

        $usr     = auth()->user()->email;
        $estatus = Solicitud::where('p_correo',"$usr")->get();
        
        return view('alumnos.eliminar', compact('estatus'));
    }

    public function eliminarS()
    {
        //* SE ACTUALIZO
        $usr     = auth()->user()->email;
        $estatus = Solicitud::where('p_correo',"$usr")->get();

        if (Solicitud::where('p_correo', "$usr")->where('s_estatus', "1")->exists()) {
            Solicitud::where('p_correo',"$usr")->delete();
            Session::flash('message', 'Solicitud Eliminada');
            return view('alumnos.index');
        } else {
            Session::flash('message', 'No se puede eliminar solicitud ya que no Existe o fue enviada');
            return view('alumnos.eliminar', compact('estatus'));
        }
    }
}
