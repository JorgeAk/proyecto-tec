<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Role;
use Session;
use App\Estatus;

class ProfesorController extends Controller
{
     public function asignados()
    {
        //* SE ACTUALIZO VERIFICAR

        //hacer validacion pertinente para poder mostrar las solicitudes asignadas inconsistencia de datos
        $usr=auth()->user()->username;
        $profesores=Profesor::all();
        $idp='';
        foreach ($profesores as $prof) {
            if($prof->rfc==$usr){
                $idp=$prof->id;
            }
        }
        //Nota cambiar esta consulta a un inner join relacionar solicitud con revisores (procesamiento mas rapido eficiente)
        $asignados = \DB::table('solicitudes')->where('primer_revisor','=',"$idp")->orWhere('segundo_revisor','=',"$idp")->orWhere('tercer_revisor','=',"$idp")->orWhere('cuarto_revisor','=',"$idp")->get();
        $revisores =  \DB::table('revisores')->where('id_profesor','=',"$idp")->get();
        $estatus= Estatus::all();
        return view('profesores.asignados',compact('asignados','revisores','estatus'));
        
    }

    public function actualizar_solicitud(Request $request){
        $usr=auth()->user()->username;
        $aceptar_sol = $request->input('aceptar');
        $rechaza_sol = $request->input('rechazar');
        $solicitud   = $request->input('solicitud');
        $verificar_id_revisor = Profesor::where('rfc',"$usr")->first('id');
        $date = Carbon::now();
        if(!empty($aceptar_sol)){
            $estatus_solicitud=8;
            Revisor::where('id_solicitud',"$solicitud")->where('id_profesor',"verificar_id_revisor->id")->update(['id_estatus' => $estatus_solicitud,'updated_at' => $date]);
        }else{
            if(!empty($rechaza_sol)){
                $estatus_solicitud=7;
                $quitar_rev=0;
                Revisor::where('id_solicitud',"$solicitud")->where('id_profesor',"$verificar_id_revisor->id")->update(['id_estatus' => $estatus_solicitud,'updated_at' => $date]);
            }
        }
        // verificar si es el ultimo profesor para cambiar el estatus de la solicitud contar cuantos son
        $v_estatus_sol = Revisor::where('id_estatus','8')->count();
        if($v_estatus_sol==3){
            Solicitud::where('id',"$solicitud")->update(['s_estatus'=>"3",'updated_at' => $date]);
        }

        Session::flash('message','Todo Correcto');
        	return view('profesores.index');

    }
    public function alumnoD($id)
    {
        $usr      = auth()->user()->username;
        $alumno   = Solicitud::where('id',"$id")->get();
        $profesor = Profesor::where('rfc',"$usr")->first('id');
        if(count($alumno)){
        	foreach ($alumno as $alumnos ) {
        	if($alumnos->primer_revisor==$profesor->id or $alumnos->segundo_revisor==$profesor->id or $alumnos->tercer_revisor==$profesor->id or $alumnos->cuarto_revisor==$profesor->id ){
        		
        	return view('profesores.detalles',compact('alumno'));

        	}else{       
            Session::flash('message','Error no tiene asigando este alumno');
        	return view('profesores.index');
        	}
        	
        }

        }else{
        	Session::flash('message','Error no tiene asigando este alumno');
        	return view('profesores.index');
        }        
        
   
        
    }
    public function ceremonias(){
        $usr=auth()->user()->username;
        $ceremonia =\DB::table('ceremonias')->where('presidente','=',"$usr")->orWhere('secretario','=',"$usr")->orWhere('v_propietario','=',"$usr")->orWhere('v_suplente','=',"$usr")->get();
        return view('profesores.eventos',compact('ceremonia')); 
    }  
}
 