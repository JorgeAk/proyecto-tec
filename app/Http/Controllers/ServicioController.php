<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use Carbon\Carbon;
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


class ServicioController extends Controller
{
    public function index(){
        //$alumno = \DB::table('solicitudes')->get();
        
        $alumno = Solicitud::where('s_estatus','!=','1')->get();
        return view('servicio.index',compact('alumno'));
   }

   public function obtener_solicitudes(){
       $planes     = Plan::all();
       $titulacion = Optitulacion::all();
       $alumno     = Solicitud::where('s_estatus','!=','1')->get();
       $estatus    = Estatus::all();
       $revisores  = Revisor::all();
       $sinodales  = Sinodal::all();
       $profesores = Profesor::all();
       return view('servicio.solicitudes',compact('alumno','planes','titulacion','estatus','profesores','revisores','sinodales'));
    }
    public function detalle_solicitud($id){
        
        $usr             = auth()->user()->id;
        $solicitud       = Solicitud::where('id',"$id")->get();
        $planes          = Plan::all();
        $op_titulaciones = Optitulacion::all();
        $profesores      = Profesor::all();
        $revisores       = Revisor::all();
        $sinodales       = Sinodal::all();
        return view('servicio.detalles',compact('solicitud','planes','op_titulaciones','profesores','revisores','sinodales')); 
    }
    public function obtener_revisores(){

        $alumno     = Solicitud::all();
        $revisores  = Revisor::all();
        $profesores = Profesor::all();
        $estatus    = Estatus::all();
        return view('servicio.solicitud_revisores',compact('alumno','revisores','profesores','estatus'));
    }

     public function obtener_sinodales(){
    	$alumno     = Solicitud::all();
        $sinodales  = Sinodal::all();
        $profesores = Profesor::all();
        $estatus    = Estatus::all();
        return view('servicio.solicitud_sinodales',compact('alumno','sinodales','profesores','estatus'));
    }
    public function actualizar_solicitud(Request $request)
    {
        $usuario         = $request->input('solicitud');
        $p_rev           = $request->input('p_r');
        $s_rev           = $request->input('s_r');
        $t_rev           = $request->input('t_r');
        $primer_revisor  = $request->input('primer_revisor');
        $segundo_revisor = $request->input('segundo_revisor');
        $tercer_revisor  = $request->input('tercer_revisor');
        //$cuart_revisor=$request->input('cuarto_revisor');

        $presidente=$request->input('presidente');
        $secretario=$request->input('secretario');
        $vocal=$request->input('v_propietario');
        $vocal_suplente=$request->input('v_suplente');
        $estatus=6;
        $estatus_solicitud=2;
        $comentario="";
        $date = Carbon::now();

        

        //dd($_POST);
        if(!empty($presidente) and !empty($secretario) and !empty($vocal) and !empty($vocal_suplente)){

            if (!empty($_POST)) {
                $i = 1;
                foreach ($_POST as $key => $value) {
                    if (trim($value) != '') {
                        $sqlArr[$key] = "$value";
                    }
                }
                unset($sqlArr['_token']);
                unset($sqlArr['solicitud']);
                unset($sqlArr['p_r']);
                unset($sqlArr['s_r']);
                unset($sqlArr['t_r']);
               
                
                $obtener_sinodales=DB::table('sinodales')->where('id_solicitud','=',"$usuario")->get();
                $obtener_sinodales_solicitud=DB::table('sinodales')->where('id','=',"$usuario")->get();
                $verificar_presidente_revisor =DB::table('sinodales')->where('id_profesor','=',"$presidente")->where('id_solicitud','=',"$usuario")->first('id');
                $verificar_secretario_revisor =DB::table('sinodales')->where('id_profesor','=',"$secretario")->where('id_solicitud','=',"$usuario")->first('id');
                $verificar_vocal_revisor =DB::table('sinodales')->where('id_profesor','=',"$vocal")->where('id_solicitud','=',"$usuario")->first('id');
                $verificar_vocal_s_revisor =DB::table('sinodales')->where('id_profesor','=',"$vocal_suplente")->where('id_solicitud','=',"$usuario")->first('id');
                
                if(count($obtener_sinodales)>0){
    
                    //dd($p_rev,$s_rev,$t_rev,$verificar_p_revisor->id,$verificar_s_revisor->id,$verificar_t_revisor,$primer_revisor,$segundo_revisor,$tercer_revisor);
                    DB::table('sinodales')->where('id', '=', "$verificar_presidente_revisor->id")->update(['id_profesor' => $presidente,'id_estatus' => "{$estatus}",'updated_at' => $date]);
                    DB::table('sinodales')->where('id', '=', "$verificar_secretario_revisor->id")->update(['id_profesor' => $secretario,'id_estatus' => "{$estatus}",'updated_at' => $date]);
                    DB::table('sinodales')->where('id', '=', "$verificar_vocal_revisor->id")->update(['id_profesor' => $vocal,'id_estatus' => "{$estatus}",'updated_at' => $date]);
                    DB::table('sinodales')->where('id', '=', "$verificar_vocal_s_revisor->id")->update(['id_profesor' => $vocal_suplente,'id_estatus' => "{$estatus}",'updated_at' => $date]);
                     
                }else{
                 DB::table('sinodales')->insertGetId(['id_profesor' => "{$presidente}",'id_solicitud' => "{$usuario}",'id_estatus' => "{$estatus}",'comentario' => "{$comentario}",'created_at'=>"{$date}",'updated_at' => "{$date}"]);
                 DB::table('sinodales')->insertGetId(['id_profesor' => "{$secretario}",'id_solicitud' => "{$usuario}",'id_estatus' => "{$estatus}",'comentario' => "{$comentario}",'created_at'=>"{$date}",'updated_at' => "{$date}"]);
                 DB::table('sinodales')->insertGetId(['id_profesor' => "{$vocal}",'id_solicitud' => "{$usuario}",'id_estatus' => "{$estatus}",'comentario' => "{$comentario}",'created_at'=>"{$date}",'updated_at' => "{$date}"]);
                 DB::table('sinodales')->insertGetId(['id_profesor' => "{$vocal_suplente}",'id_solicitud' => "{$usuario}",'id_estatus' => "{$estatus}",'comentario' => "{$comentario}",'created_at'=>"{$date}",'updated_at' => "{$date}"]);
                }
                $usuario_r = DB::table('solicitudes')->where('id', '=', "$usuario")->update($sqlArr);
                //$usuario_r = DB::table('solicitudes')->where('id', '=', "$usuario")->update(['s_estatus' => $estatus_solicitud,'updated_at' => $date]);
      
            }
            

        }else{
            

            if(!empty($primer_revisor) and !empty($segundo_revisor) and !empty($tercer_revisor)){
                if (!empty($_POST)) {
                    $i = 1;
                    foreach ($_POST as $key => $value) {
                        if (trim($value) != '') {
                            $sqlArr[$key] = "$value";
                        }
                    }
                    unset($sqlArr['_token']);
                    unset($sqlArr['solicitud']);
                    unset($sqlArr['p_r']);
                    unset($sqlArr['s_r']);
                    unset($sqlArr['t_r']);
                    
                    $obtener_revisores=DB::table('revisores')->where('id_solicitud','=',"$usuario")->get();
                    $obtener_revisores_solicitud=DB::table('solicitudes')->where('id','=',"$usuario")->get();
                    $verificar_p_revisor =DB::table('revisores')->where('id_profesor','=',"$p_rev")->where('id_solicitud','=',"$usuario")->first('id');
                    $verificar_s_revisor =DB::table('revisores')->where('id_profesor','=',"$s_rev")->where('id_solicitud','=',"$usuario")->first('id');
                    $verificar_t_revisor =DB::table('revisores')->where('id_profesor','=',"$t_rev")->where('id_solicitud','=',"$usuario")->first('id');
                    //$verificar_c_revisor =DB::table('revisores')->where('id_profesor','=',"$primer_revisor");
                    
                    if(count($obtener_revisores)>0){
        
                        //dd($p_rev,$s_rev,$t_rev,$verificar_p_revisor->id,$verificar_s_revisor->id,$verificar_t_revisor,$primer_revisor,$segundo_revisor,$tercer_revisor);
                        DB::table('revisores')->where('id', '=', "$verificar_p_revisor->id")->update(['id_profesor' => $primer_revisor,'id_estatus' => "{$estatus}",'updated_at' => $date]);
                        DB::table('revisores')->where('id', '=', "$verificar_s_revisor->id")->update(['id_profesor' => $segundo_revisor,'id_estatus' => "{$estatus}",'updated_at' => $date]);
                        DB::table('revisores')->where('id', '=', "$verificar_t_revisor->id")->update(['id_profesor' => $tercer_revisor,'id_estatus' => "{$estatus}",'updated_at' => $date]);
                         
                    }else{
                     DB::table('revisores')->insertGetId(['id_profesor' => "{$primer_revisor}",'id_solicitud' => "{$usuario}",'id_estatus' => "{$estatus}",'comentario' => "{$comentario}",'created_at'=>"{$date}",'updated_at' => "{$date}"]);
                     DB::table('revisores')->insertGetId(['id_profesor' => "{$segundo_revisor}",'id_solicitud' => "{$usuario}",'id_estatus' => "{$estatus}",'comentario' => "{$comentario}",'created_at'=>"{$date}",'updated_at' => "{$date}"]);
                     DB::table('revisores')->insertGetId(['id_profesor' => "{$tercer_revisor}",'id_solicitud' => "{$usuario}",'id_estatus' => "{$estatus}",'comentario' => "{$comentario}",'created_at'=>"{$date}",'updated_at' => "{$date}"]);
                    }
                    $usuario_r = DB::table('solicitudes')->where('id', '=', "$usuario")->update($sqlArr);
                    $usuario_r = DB::table('solicitudes')->where('id', '=', "$usuario")->update(['s_estatus' => $estatus_solicitud,'updated_at' => $date]);
          
                }

            }

            


        }
        

        $alumno = \DB::table('solicitudes')->get();
            Session::flash('message', 'Solicitud Actualizada');
            return view('servicio.index',compact('alumno'));




    }

}
