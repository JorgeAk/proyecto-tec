<?php

use Illuminate\Database\Seeder;

class estatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estatus')->insert([
            'nombre' => 'CAPTURA DE SOLICITUD'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'SOLICITUD ENVIADA'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'EN REVISIÓN'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'TRAMITE DE TITULACIÓN'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'ALUMNO TITULADO'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'PENDIENTE POR ACEPTAR/RECHAZAR'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'SOLICITUD NO ACEPTADA POR EL REVISOR'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'SOLICITUD SI ACEPTADA POR EL REVISOR'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'PROYECTO RECHAZADO POR EL REVISOR'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'NO ACEPTA SER SINODAL'
        ]);

        DB::table('estatus')->insert([
            'nombre' => 'SI ACEPTA SER SINODAL'
        ]);
        
        
    }
}
