<?php

use Illuminate\Database\Seeder;

class optitulacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('optitulacion')->insert([
            'nombre' => 'TESIS',
            'id_plan' => '1',
        ]);
        DB::table('optitulacion')->insert([
            'nombre' => 'PROYECTO DE INVESTIGACION',
            'id_plan' => '1',
        ]);
        DB::table('optitulacion')->insert([
            'nombre' => 'INFORME TÉCNICO DE  RESIDENCIA',
            'id_plan' => '1',
        ]);
        DB::table('optitulacion')->insert([
            'nombre' => 'CENEVAL',
            'id_plan' => '1',
        ]);
       

    }
}
