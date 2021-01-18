<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
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


class DocenciaController extends Controller
{
    public function obtener(){
         //$alumno = \DB::table('solicitudes')->get();
         
         $alumno = Solicitud::where('s_estatus','!=','2')->get();
        $nuevas = Solicitud::where('s_estatus','2')->count();
        $aceptado = Solicitud::where('s_estatus','12')->count();
        $revision = Solicitud::where('s_estatus','3')->count();
        $rechazado = Solicitud::where('s_estatus','9')->count();
    	 return view('docencia.index',compact('alumno','nuevas','aceptado','revision','rechazado'));
    }

    public function resumen(){
        $nuevas = Solicitud::where('s_estatus','!=','2')->count();
        $aceptado = Solicitud::where('s_estatus','!=','12')->count();
        $revision = Solicitud::where('s_estatus','!=','3')->count();
        $rechazado = Solicitud::where('s_estatus','!=','9')->count();

        $solicitudes= array('nuevas'=>$nuevas,'aceptado'=> $aceptado,'revision'=>$revision,'rechazado'=> $rechazado);

    	return response()->json($solicitudes);
    }
    
    public function obtener_solicitudes(){
        $planes     = Plan::all();
        $titulacion = Optitulacion::all();
        $alumno     = Solicitud::where('s_estatus','!=','1')->get();
        $estatus    = Estatus::all();
        $revisores  = Revisor::all();
        $sinodales  = Sinodal::all();
        $profesores = Profesor::all();

    	return view('docencia.solicitudes',compact('alumno','planes','titulacion','estatus','profesores','revisores','sinodales'));
    }

    public function detalle_solicitud($id)
    {
        $usr             = auth()->user()->id;
        $solicitud       = Solicitud::where('id',"$id")->get();
        $planes          = Plan::all();
        $op_titulaciones = Optitulacion::all();
        $profesores      = Profesor::all();
        $revisores       = Revisor::all();
        $sinodales       = Sinodal::all();
        return view('docencia.detalles',compact('solicitud','planes','op_titulaciones','profesores','revisores','sinodales')); 
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
            return view('docencia.index',compact('alumno'));




    }

     public function obtener_revisores(){

        $alumno     = Solicitud::all();
        $revisores  = Revisor::all();
        $profesores = Profesor::all();
        $estatus    = Estatus::all();
        return view('docencia.solicitudes_revisores',compact('alumno','revisores','profesores','estatus'));
    }

     public function obtener_sinodales(){
    	$alumno     = Solicitud::all();
        $sinodales  = Sinodal::all();
        $profesores = Profesor::all();
        $estatus    = Estatus::all();
        return view('docencia.solicitudes_sinodales',compact('alumno','sinodales','profesores','estatus'));
    }

    

    public function obtener_profesores(){
        $plan       = Plan::all();
        $titulacion = Optitulacion::all(); 
        $profesores = Profesor::all();
    	return view('docencia.profesores',compact('profesores','plan','titulacion'));
    }

    public function actualizar_profesores(Request $request){
        $usuario = $request->input('username');
        $p_nombre = $request->input('p_nombre');
        $rfc = $request->input('rfc');
        $correo = $request->input('correo');
        $password = $request->input('password');
        $date = Carbon::now();
    	if (!empty($_POST) and !empty($usuario)) {
            $i = 1;
            foreach ($_POST as $key => $value) {
                if (trim($value) != '') {
                    $sqlArr[$key] = "$value";
                }
            }
            unset($sqlArr['_token']);
            unset($sqlArr['username']);
            unset($sqlArr['password']);

            $profesor = DB::table('profesores')->where('rfc', '=', "$usuario")->update($sqlArr);
            $fech_act = DB::table('profesores')->where('rfc', '=', "$usuario")->update(['updated_at'=>$date]);
            if(!empty($p_nombre)){
                DB::table('users')->where('username', '=', "$usuario")->update(['name'=>$p_nombre]);
                $fech_act = DB::table('profesores')->where('rfc', '=', "$usuario")->update(['updated_at'=>$date]);
            }
            if(!empty($rfc)){
                $user=DB::table('users')->where('username', '=', "$usuario")->update(['email'=>$correo]);
                $fech_act = DB::table('users')->where('username', '=', "$usuario")->update(['updated_at'=>$date]);

            }
            if(!empty($correo)){
                $user=DB::table('users')->where('username', '=', "$usuario")->update(['username'=>$rfc,]);
                $fech_act = DB::table('users')->where('username', '=', "$usuario")->update(['updated_at'=>$date]);

            }
            if(!empty($password)){
                $user=DB::table('users')->where('username', '=', "$usuario")->update(['password'=>Hash::make($password)]);
                $fech_act = DB::table('users')->where('username', '=', "$usuario")->update(['updated_at'=>$date]);

            }
            
            Session::flash('message', 'Profesor Actualizado');
            $alumno = \DB::table('solicitudes')->get();
            return view('docencia.index',compact('alumno'));
         
        }
    }

    public function agregar_profesores(Request $request){
        $p_nombre = $request->input('p_nombre');
        $s_nombre = $request->input('s_nombre');
        $paterno = $request->input('a_paterno');
        $materno = $request->input('a_materno');
        $rfc = $request->input('rfc');
        $correo = $request->input('correo');
        $celular= $request->input('celular');
        $departamento=$request->input('departamento');
        $password = $request->input('password');
        $estatus = $request->input('estatus');
        $date = Carbon::now();
        $obtener_usuario = \DB::table('profesores')->where('rfc', '=', "$rfc")->count();
        $obtener_registro =\DB::table('users')->where('username', '=', "$rfc")->count(); 
        if($obtener_usuario>0 or $obtener_registro >0){
            Session::flash('message', 'Este profesor ya existe favor de verificar datos');
            $alumno = \DB::table('solicitudes')->get();
            return view('docencia.index',compact('alumno'));

        }else{
            $user = User::create([
                'name' => $p_nombre,
                'username' => $rfc,
                'estatus' => $estatus,
                'email' => $correo,
                'password' => Hash::make($password),
            ]);
            $user->roles()->attach(Role::where('name', 'profesor')->first()); 
            $profe = DB::table('profesores')->insertGetId(['p_nombre' => "{$p_nombre}", 's_nombre' => "{$s_nombre}", 'a_paterno' => "{$paterno}", 'a_materno' => "{$materno}", 'rfc' => "{$rfc}",  'celular' => "{$celular}", 'correo' => "{$correo}",  'departamento' => "{$departamento}",'estatus' => "{$estatus}",'created_at' => "{$date}", 'updated_at' => "{$date}"]);
            Session::flash('message', 'Profesor Agregado');
            $alumno = \DB::table('solicitudes')->get();
            return view('docencia.index',compact('alumno'));

        }

        /*$v = \Validator::make($request->all(), [
            'p_nombre' => ['required', 'string', 'max:255'],
            'rfc' => ['required', 'string', 'max:255', 'unique:users'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }*/ 
    	
    }

    public function obtener_carreras(){
            $carreras = Carrera::all();
            return view('docencia.carreras',compact('carreras'));
    }

    public function agregar_carrera(Request $request){
        $nombre = $request->input('nombre');
        $estatus = $request->input('estatus');
        $date = Carbon::now();
        $carrera = DB::table('carreras')->insertGetId(['nombre' => "{$nombre}", 'estatus' => "{$estatus}",'created_at' => "{$date}", 'updated_at' => "{$date}"]);
    	Session::flash('message', 'Nueva Carrera agregada');
            $alumno = \DB::table('solicitudes')->get();
            return view('docencia.index',compact('alumno'));
    }

    public function actualizar_carrera(Request $request){
        $id_carrera = $request->input('id_carrera');
        $date = Carbon::now();
    	foreach ($_POST as $key => $value) {
            if (trim($value) != '') {
                $sqlArr[$key] = "$value";
            }
        }
        unset($sqlArr['_token']);
        unset($sqlArr['id_carrera']);
        if(!empty($id_carrera and !empty($sqlArr))){
            $profesor = DB::table('carreras')->where('id', '=', "$id_carrera")->update($sqlArr);
            $fech_act = DB::table('carreras')->where('id', '=', "$id_carrera")->update(['updated_at'=>$date]);
            $mensaje="Carrera Actualizada";

        }else{
            $mensaje="ERROR Carrera NO Actualizada";
        }

    	Session::flash('message', $mensaje);
            $alumno = \DB::table('solicitudes')->get();
            return view('docencia.index',compact('alumno'));
    }

    //Planes/////////////////////

    public function obtener_planes(){
        $planes = Plan::all();
        return view('docencia.planes',compact('planes'));
}

public function agregar_planes(Request $request){
    $nombre = $request->input('nombre');
    $year = $request->input('anio');
    $date = Carbon::now();
    $plan = DB::table('planes')->insertGetId(['nombre' => "{$nombre}", 'anio' => "{$year}",'created_at' => "{$date}", 'updated_at' => "{$date}"]);
    Session::flash('message', 'Nuevo plan agregado');
        $alumno = \DB::table('solicitudes')->get();
        return view('docencia.index',compact('alumno'));
}

public function actualizar_planes(Request $request){
    $id_plan = $request->input('id_plan');
    $date = Carbon::now();
    foreach ($_POST as $key => $value) {
        if (trim($value) != '') {
            $sqlArr[$key] = "$value";
        }
    }
    unset($sqlArr['_token']);
    unset($sqlArr['id_plan']);
    if(!empty($id_plan) and !empty($sqlArr)){
        $profesor = DB::table('planes')->where('id', '=', "$id_plan")->update($sqlArr);
        $fech_act = DB::table('planes')->where('id', '=', "$id_plan")->update(['updated_at'=>$date]);
        $mensaje="Plan Actualizado";

    }else{
        $mensaje="ERROR Plan NO Actualizado";
    }

    Session::flash('message', $mensaje);
        $alumno = \DB::table('solicitudes')->get();
        return view('docencia.index',compact('alumno'));
}

public function agregar_usuario_rol(Request $request){
    $nombre = $request->input('name');
    $username= $request->input('username');
    $email= $request->input('email');
    $password= $request->input('password');
    $estatus =$request->input('estatus');
    $rol= $request->input('rol');
    $verificar_usuario=User::where('username','=',$username)->first();
    if(empty($verificar_usuario)){
        $usuario = new User;
        $usuario->name=$nombre;
        $usuario->username=$username;
        $usuario->estatus=$estatus;
        $usuario->email=$email;
        $usuario->password=Hash::make($password);
        $usuario->save();
        $obtener_id_user=$usuario->id;
        $fecha= Carbon::now();
        $new_rol=\DB::table('role_user')->insert(['role_id'=>$rol,'user_id'=>$obtener_id_user,'created_at'=>$fecha,'updated_at'=>$fecha]);
        Session::flash('message', 'Usuario registrado con Exito!');
        $alumno = \DB::table('solicitudes')->get();
        return view('docencia.index',compact('alumno'));
    }else{
        Session::flash('message', 'Este usuario ya existe favor de verificar');
        $alumno = \DB::table('solicitudes')->get();
        return view('docencia.index',compact('alumno'));

    }
}

public function actualizar_usuario_rol(Request $request){
    $nombre = $request->input('name');
    $user=$request->input('user');
    $username= $request->input('username');
    $id_usr=$request->input('id_usr');
    $email= $request->input('email');
    $password= $request->input('password');
    $estatus =$request->input('estatus');
    $rol= $request->input('rol');
    $verificar_usuario=User::where('username','=',$user)->first();

    if (!empty($_POST) and !empty($user) and !empty($id_usr)) {
        $i = 1;
        foreach ($_POST as $key => $value) {
            if (trim($value) != '') {
                $sqlArr[$key] = "$value";
            }
        }
        unset($sqlArr['_token']);
        unset($sqlArr['user']);
        unset($sqlArr['rol']);
        unset($sqlArr['id_usr']);
        unset($sqlArr['password']);
        //dd($sqlArr);
        $n_usuario = DB::table('users')->where('id', $id_usr)->update($sqlArr);
        
        if(!empty($password)){
            $n_usuario_pw = DB::table('users')->where('id', '=', "$id_usr")->update(['password'=>Hash::make($password)]);
        }

        if(!empty($rol)){
            $n_rol = DB::table('role_user')->where('user_id', '=', "$id_usr")->update(['role_id'=>$rol]);

        }
        //dd($n_usuario);
        Session::flash('message', 'Usuario Actualizado con Exito!');
        $alumno = \DB::table('solicitudes')->get();
        return view('docencia.index',compact('alumno'));
    
    }else{
        Session::flash('message', 'ERROR al Actualizar verifica datos');
        $alumno = \DB::table('solicitudes')->get();
        return view('docencia.index',compact('alumno'));
        

    }
}


public function eliminar_usuario_rol($id){
    DB::table('users')->where('id', '=', $id)->delete();
    DB::table('role_user')->where('user_id', '=', $id)->delete();

    Session::flash('message', 'Usuario Eliminado con Exito!');
        $alumno = \DB::table('solicitudes')->get();
        return view('docencia.index',compact('alumno'));
}
   




    


}
