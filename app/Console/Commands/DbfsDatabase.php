<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Actual;
use App\Models\Responsables;
use App\Models\Oficinas;
use XBase\Enum\FieldType;
use XBase\Enum\TableType;
use XBase\Header\Column;
use XBase\Header\HeaderFactory;
use XBase\TableCreator;
use XBase\TableEditor;
use XBase\TableReader;

class DbfsDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup de base de datos Vsiaf';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            //$this->deleteDBF();
            $this->editarActual();
            $this->editarAuxiliar();
            //$this->llenarDBF();
            $this->editarResponsable();
            $this->editarOficina();
            return Command::SUCCESS;
        } catch (Exception $e) {

           return Comand::ERROR;
            // return response()->json(['message' => 'Excepción capturada: '.$e->getMessage()]);
        }
    }
    public function deleteDBF()
    {
        try {
             // Ruta del archivo
            $filePath = public_path('vsiaf/dbfs/ACTUAL.DBF');
            // Verifica si el archivo existe
            if (file_exists($filePath) ) {
            // Elimina el archivo
            //Storage::delete($filePath);
            unlink($filePath);
           
            $this->createDBF();
            } else {
                $this->createDBF();
            }
        
        } catch (Exception $e) {

           return print_r("hubo un error");
            // return response()->json(['message' => 'Excepción capturada: '.$e->getMessage()]);
        }
    }
    public function deleteRespDBF()
    {
        try {
             // Ruta del archivo
            $filePath = public_path('vsiaf/dbfs/resp.DBF');
            // Verifica si el archivo existe
            if (file_exists($filePath) ) {
            // Elimina el archivo
            //Storage::delete($filePath);
            unlink($filePath);
           
            $this->createRespDBF();
            } else {
                $this->createRespDBF();
            }
        
        } catch (Exception $e) {

           return print_r("hubo un error");
            // return response()->json(['message' => 'Excepción capturada: '.$e->getMessage()]);
        }
    }
    public function deleteOficinas()
    {
        try {
             // Ruta del archivo
            $filePath = public_path('vsiaf/dbfs/oficina.DBF');
            // Verifica si el archivo existe
            if (file_exists($filePath) ) {
            // Elimina el archivo
            //Storage::delete($filePath);
            unlink($filePath);
           
            $this->createOficinaDBF();
            } else {
                $this->createOficinaDBF();
            }
        
        } catch (Exception $e) {

           return print_r("hubo un error");
            // return response()->json(['message' => 'Excepción capturada: '.$e->getMessage()]);
        }
    }
    protected function createDBF(){
        $header = HeaderFactory::create(TableType::DBASE_III_PLUS_MEMO);
        $filepath = public_path('vsiaf/dbfs/ACTUAL.DBF');

        $tableCreator = new TableCreator($filepath, $header);
        $tableCreator
            ->addColumn(new Column([
                'name'   => 'unidad',
                'type'   => FieldType::CHAR,
                'length' => 5,
            ]))
            ->addColumn(new Column([
                'name'   => 'entidad',
                'type'   => FieldType::CHAR,
                'length' => 4,
            ]))
            ->addColumn(new Column([
                'name'   => 'codigo',
                'type'   => FieldType::CHAR,
                'length' => 15,
            ]))
            ->addColumn(new Column([
                'name'         => 'codcont',
                'type'         => FieldType::NUMERIC,
                'length'       => 2,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'         => 'codaux',
                'type'         => FieldType::NUMERIC,
                'length'       => 3,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'         => 'vidautil',
                'type'         => FieldType::NUMERIC,
                'length'       => 6,
                'decimalCount' => 2,
            ]))
            ->addColumn(new Column([
                'name'   => 'descrip',
                'type'   => FieldType::CHAR,
                'length' => 150,
            ]))
            ->addColumn(new Column([
                'name'         => 'costo',
                'type'         => FieldType::NUMERIC,
                'length'       => 15,
                'decimalCount' => 2,
            ]))
            ->addColumn(new Column([
                'name'         => 'depacu',
                'type'         => FieldType::NUMERIC,
                'length'       => 15,
                'decimalCount' => 2,
            ]))
            ->addColumn(new Column([
                'name'         => 'mes',
                'type'         => FieldType::NUMERIC,
                'length'       => 2,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'         => 'ano',
                'type'         => FieldType::NUMERIC,
                'length'       => 4,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'   => 'b_rev',
                'type'   => FieldType::LOGICAL,
            ]))
            ->addColumn(new Column([
                'name'         => 'dia',
                'type'         => FieldType::NUMERIC,
                'length'       => 2,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'         => 'codofic',
                'type'         => FieldType::NUMERIC,
                'length'       => 4,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'         => 'codresp',
                'type'         => FieldType::NUMERIC,
                'length'       => 5,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'   => 'observ',
                'type'   => FieldType::MEMO,
                'length'       => 10,
            ]))
            ->addColumn(new Column([
                'name'         => 'dia_ant',
                'type'         => FieldType::NUMERIC,
                'length'       => 2,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'         => 'mes_ant',
                'type'         => FieldType::NUMERIC,
                'length'       => 2,
                'decimalCount' => 0,
            ])) 
            ->addColumn(new Column([
                'name'         => 'ano_ant',
                'type'         => FieldType::NUMERIC,
                'length'       => 4,
                'decimalCount' => 0,
            ]))  
            ->addColumn(new Column([
                'name'         => 'vut_ant',
                'type'         => FieldType::NUMERIC,
                'length'       => 3,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'         => 'costo_ant',
                'type'         => FieldType::NUMERIC,
                'length'       => 15,
                'decimalCount' => 2,
            ]))
            ->addColumn(new Column([
                'name'   => 'band_ufv',
                'type'   => FieldType::LOGICAL,
            ]))
            ->addColumn(new Column([
                'name'         => 'codestado',
                'type'         => FieldType::NUMERIC,
                'length'       => 2,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'   => 'cod_rube',
                'type'   => FieldType::CHAR,
                'length' => 15,
            ]))
            ->addColumn(new Column([
                'name'   => 'nro_conv',
                'type'   => FieldType::CHAR,
                'length' => 10,
            ]))
            ->addColumn(new Column([
                'name'   => 'org_fin',
                'type'   => FieldType::CHAR,
                'length' => 3,
            ]))
            ->addColumn(new Column([
                'name'   => 'feult',
                'type'   => FieldType::DATE,
                'length' => 8,
            ]))
            ->addColumn(new Column([
                'name'   => 'usuar',
                'type'   => FieldType::CHAR,
                'length' => 8,
            ]))
            ->addColumn(new Column([
                'name'         => 'api_estado',
                'type'         => FieldType::NUMERIC,
                'length'       => 1,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'   => 'codigosec',
                'type'   => FieldType::CHAR,
                'length' => 15,
            ]))
            ->addColumn(new Column([
                'name'   => 'banderas',
                'type'   => FieldType::CHAR,
                'length' => 12,
            ]))
            ->addColumn(new Column([
                'name'   => 'fec_mod',
                'type'   => FieldType::DATE,
                'length' => 8,
            ]))
            ->addColumn(new Column([
                'name'   => 'usu_mod',
                'type'   => FieldType::CHAR,
                'length' => 8,
            ]))
            ->save(); //creates file

    }
    protected function llenarDBF(){
       $actuales = Actual::all();
        try {
            $table = new TableEditor(public_path('vsiaf/dbfs/ACTUAL.DBF'),['encoding' => 'cp1252']);
            for ($i=0; $i < count($actuales); $i++) {

                $record = $table->appendRecord();

                $record->set('unidad',  $actuales[$i]['unidad'] );
                $record->set('entidad', $actuales[$i]['entidad'] );
                $record->set('codigo', $actuales[$i]['codigo'] );
                $record->set('codcont', $actuales[$i]['codcont'] );
                $record->set('codaux', $actuales[$i]['codaux'] );
                $record->set('vidautil', $actuales[$i]['vidautil'] );
                $record->set('descrip', $actuales[$i]['descripcion'] );
                $record->set('costo', $actuales[$i]['costo'] );
                $record->set('depacu', $actuales[$i]['depacu'] );
                $record->set('mes', $actuales[$i]['mes'] );
                $record->set('ano', $actuales[$i]['año'] );
                $record->set('b_rev', (boolean)$actuales[$i]['b_rev'] );
                $record->set('dia', $actuales[$i]['dia'] );
                $record->set('codofic', $actuales[$i]['codofic'] );
                $record->set('codresp', $actuales[$i]['codresp'] );
                $record->set('observ', $actuales[$i]['observ'] );
                $record->set('dia_ant', $actuales[$i]['dia_ant'] );
                $record->set('mes_ant', $actuales[$i]['mes_ant'] );
                $record->set('ano_ant', $actuales[$i]['año_ant'] );
                $record->set('vut_ant', $actuales[$i]['vut_ant'] );
                $record->set('costo_ant', $actuales[$i]['costo_ant'] );
                $record->set('band_ufv', (boolean)$actuales[$i]['band_ufv'] );
                $record->set('codestado', $actuales[$i]['codestado'] );
                $record->set('cod_rube', $actuales[$i]['cod_rube'] );
                $record->set('nro_conv', $actuales[$i]['nro_conv'] );
                $record->set('org_fin', $actuales[$i]['org_fin'] );
                $record->set('usuar', $actuales[$i]['usuar'] );
                $record->set('api_estado', $actuales[$i]['api_estado'] );
                $record->set('codigosec', $actuales[$i]['codigosec'] );
                $record->set('banderas', $actuales[$i]['banderas'] );
                $record->set('fec_mod', $actuales[$i]['fec_mod'] );
                $record->set('usu_mod', $actuales[$i]['usu_mod'] );

                $table->writeRecord()->save();
            }
            $table->close();
            return response()->json(['message' => 'Datos Actualizados Correctamente!!!']);
            } catch (Exception $e) {
                return print_r("hubo un error");
            //return response()->json(['message' => 'Excepción capturada: '.$e->setMessage()]);
            }
            
    }
    protected function createRespDBF(){
        $header = HeaderFactory::create(TableType::DBASE_III_PLUS_MEMO);
        $filepath = public_path('vsiaf/dbfs/resp.DBF');

        $tableCreator = new TableCreator($filepath, $header);
        $tableCreator
            ->addColumn(new Column([
                'name'   => 'entidad',
                'type'   => FieldType::CHAR,
                'length' => 4,
            ]))
            ->addColumn(new Column([
                'name'   => 'unidad',
                'type'   => FieldType::CHAR,
                'length' => 5,
            ]))
            ->addColumn(new Column([
                'name'   => 'codofic',
                'type'   => FieldType::NUMERIC,
                'length' => 4,
            ]))
            ->addColumn(new Column([
                'name'         => 'codresp',
                'type'         => FieldType::NUMERIC,
                'length'       => 5,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'   => 'nomresp',
                'type'   => FieldType::CHAR,
                'length' => 35,
            ]))
            ->addColumn(new Column([
                'name'   => 'cargo',
                'type'   => FieldType::CHAR,
                'length' => 35,
            ]))
            ->addColumn(new Column([
                'name'   => 'observ',
                'type'   => FieldType::MEMO,
                'length'       => 10,
            ]))
            ->addColumn(new Column([
                'name'         => 'ci',
                'type'         => FieldType::CHAR,
                'length'       => 20,
            ]))
            ->addColumn(new Column([
                'name'   => 'feult',
                'type'   => FieldType::DATE,
                'length' => 8,
            ]))
            ->addColumn(new Column([
                'name'   => 'usuar',
                'type'   => FieldType::CHAR,
                'length' => 8,
            ]))
            ->addColumn(new Column([
                'name'         => 'cod_exp',
                'type'         => FieldType::NUMERIC,
                'length'       => 2,
                'decimalCount' => 0,
            ]))
            ->addColumn(new Column([
                'name'   => 'api_estado',
                'type'   => FieldType::NUMERIC,
                'length' => 1,
            ]))
            ->save(); //creates file

    }
    protected function llenarRespDBF(){
       $responsables = Responsables::all();
        try {
            $table = new TableEditor(public_path('vsiaf/dbfs/resp.DBF'),['encoding' => 'cp1252']);
            for ($i=0; $i < count($responsables); $i++) {

                $record = $table->appendRecord();
                $record->set('entidad', $responsables[$i]['entidad'] );
                $record->set('unidad',  $responsables[$i]['unidad'] );
                $record->set('codofic', $responsables[$i]['codofic'] );
                $record->set('codresp', $responsables[$i]['codresp'] );
                $record->set('nomresp', $responsables[$i]['nomresp'] );
                $record->set('cargo', $responsables[$i]['cargo'] );
                $record->set('ci', $responsables[$i]['ci'] );
                $record->set('feult', $responsables[$i]['feult'] );
                $record->set('usuar', $responsables[$i]['usuar'] );
                $record->set('cod_exp', $responsables[$i]['cod_exp'] );
                $record->set('api_estado', $responsables[$i]['api_estado'] );
                $table->writeRecord()->save();
            }
            $table->close();
            return response()->json(['message' => 'Datos Actualizados Correctamente!!!']);
            } catch (Exception $e) {
                return print_r("hubo un error");
            //return response()->json(['message' => 'Excepción capturada: '.$e->setMessage()]);
            }
            
    }
    protected function createOficinaDBF(){
        $header = HeaderFactory::create(TableType::DBASE_III_PLUS_MEMO);
        $filepath = public_path('vsiaf/dbfs/oficina.DBF');

        $tableCreator = new TableCreator($filepath, $header);
        $tableCreator
            ->addColumn(new Column([
                'name'   => 'entidad',
                'type'   => FieldType::CHAR,
                'length' => 4,
            ]))
            ->addColumn(new Column([
                'name'   => 'unidad',
                'type'   => FieldType::CHAR,
                'length' => 5,
            ]))
            ->addColumn(new Column([
                'name'   => 'codofic',
                'type'   => FieldType::NUMERIC,
                'length' => 4,
            ]))
            ->addColumn(new Column([
                'name'   => 'nomofic',
                'type'   => FieldType::CHAR,
                'length' => 65,
            ]))
            ->addColumn(new Column([
                'name'   => 'observ',
                'type'   => FieldType::MEMO,
                'length'       => 10,
            ]))
            ->addColumn(new Column([
                'name'   => 'feult',
                'type'   => FieldType::DATE,
                'length' => 8,
            ]))
            ->addColumn(new Column([
                'name'   => 'usuar',
                'type'   => FieldType::CHAR,
                'length' => 8,
            ]))
            ->addColumn(new Column([
                'name'   => 'api_estado',
                'type'   => FieldType::NUMERIC,
                'length' => 1,
            ]))
            ->save(); //creates file

    }
    protected function llenarOficinaDBF(){
       $oficinas = Oficinas::all();
        try {
            $table = new TableEditor(public_path('vsiaf/dbfs/oficina.DBF'),['encoding' => 'cp1252']);
            for ($i=0; $i < count($oficinas); $i++) {

                $record = $table->appendRecord();
                $record->set('entidad', $oficinas[$i]['entidad'] );
                $record->set('unidad',  $oficinas[$i]['unidad'] );
                $record->set('codofic', $oficinas[$i]['codofic'] );
                $record->set('nomofic', $oficinas[$i]['nomofic'] );
                $record->set('feult', $oficinas[$i]['feult'] );
                $record->set('usuar', $oficinas[$i]['usuar'] );
                $record->set('api_estado', $oficinas[$i]['api_estado'] );
                $table->writeRecord()->save();
            }
            $table->close();
            return response()->json(['message' => 'Datos Actualizados Correctamente!!!']);
            } catch (Exception $e) {
                return print_r("hubo un error");
            //return response()->json(['message' => 'Excepción capturada: '.$e->setMessage()]);
            }
            
    }
    protected function editarActual(){
        try {
            $datos = Actual::where('estadodbf','=', 1)->get();
            $datosMap = [];
            foreach ($datos as $dato) {
                $datosMap[$dato->codigo] = [
                    'codcont' => $dato->codcont,
                    'codaux' => $dato->codaux,
                    'descripcion' => $dato->descripcion,
                    'codestado' => $dato->codestado,
                    'codigosec' => $dato->codigosec,
                ];
            }
            $table = new TableEditor(public_path('vsiaf/dbfs/ACTUAL.DBF'), ['encoding' => 'cp1252']);
                while ($record = $table->nextRecord()) {
                $codigo = $record->get('codigo');
                if (isset($datosMap[$codigo])) {
                    $dato = $datosMap[$codigo];
                    $record->set('codcont', $dato['codcont']);
                    $record->set('codaux', $dato['codaux']);
                    $record->set('descrip', $dato['descripcion']);
                    $record->set('codestado', $dato['codestado']);
                    $record->set('codigosec', $dato['codigosec']);
                    $table->writeRecord();
                }
            }
            $table->save()->close();
            Actual::where('estadodbf','=', 1)->update(['estadodbf' => 0]);

        } catch (Exception $e) {
        return response()->json(['message' => 'Excepción capturada: '+  $e->getMessage()]);
        }

    }
    protected function editarAuxiliar(){
        try {
            $datos = Auxiliares::where('estadodbf','=', 1)->get();
            $datosMap = [];
            foreach ($datos as $dato) {
                $datosMap[$dato->codaux . '|' . $dato->codcont] = [
                    'nomaux' => $dato->nomaux,
                    'codaux' => $dato->codaux,
                    'codcont' => $dato->codcont,
                ];
            }

            $table = new TableEditor(public_path('vsiaf/dbfs/auxiliar.DBF'), ['encoding' => 'cp1252']);

            while ($record = $table->nextRecord()) {
                $codaux = $record->get('codaux');
                $codcont = $record->get('codcont');
                $key = $codaux . '|' . $codcont;
                if (isset($datosMap[$key])) {
                    $dato = $datosMap[$key];
                    $record->set('nomaux', $dato['nomaux']); 
                    $table->writeRecord();
                }
            }

            $table->save()->close();

            Auxiliares::where('estadodbf','=', 1)->update(['estadodbf' => 0]);

        } catch (Exception $e) {
        return response()->json(['message' => 'Excepción capturada: '+  $e->getMessage()]);
        }

    }
    protected function editarResponsable(){
        try {
            $datos = Responsables::where('estadodbf', 1)->get();
            $datosMap = [];
            foreach ($datos as $dato) {
                $datosMap[$dato->codresp . '|' . $dato->codofic . '|' . $dato->unidad] = [
                    'entidad'=>$dato->entidad,
                    'unidad'=>$dato->unidad,
                    'codofic'=>$dato->codofic,
                    'codresp'=>$dato->codresp,
                    'nomresp'=>$dato->nomresp,
                    'cargo'=>$dato->cargo,
                    'observ'=>$dato->observ,
                    'ci'=>$dato->ci,
                    'feult'=>$dato->feult,
                    'usuar'=>$dato->usuar,
                    'cod_exp'=>$dato->cod_exp,
                    'api_estado'=>$dato->api_estado,
                ];
            }

            $table = new TableEditor(public_path('vsiaf/dbfs/RESP.DBF'), ['encoding' => 'cp1252']);
            $procesados = [];
            while ($record = $table->nextRecord()) {
                $codresp = $record->get('codresp');
                $codofic = $record->get('codofic');
                $unidad = $record->get('unidad');
                $key = $codresp . '|' . $codofic . '|' .$unidad;
                if (isset($datosMap[$key])) {
                    $dato = $datosMap[$key];
                    $record->set('nomresp', $dato['nomresp']);
                    $record->set('cargo', $dato['cargo']);
                    $record->set('ci', $dato['ci']);
                    $record->set('cod_exp', $dato['cod_exp']);
                    $table->writeRecord();
                    $procesados[$key] = true;
                }
            }
            foreach ($datosMap as $key => $dato) {
                if (!isset($procesados[$key])) {
                    $newRecord = $table->appendRecord();
                    $newRecord->set('entidad', $dato['entidad']);
                    $newRecord->set('unidad', $dato['unidad']);
                    $newRecord->set('codofic', $dato['codofic']);
                    $newRecord->set('codresp', $dato['codresp']);
                    $newRecord->set('nomresp', $dato['nomresp']);
                    $newRecord->set('cargo', $dato['cargo']);
                    $newRecord->set('observ', $dato['observ']);
                    $newRecord->set('ci', $dato['ci']);
                    $newRecord->set('feult', $dato['feult']);
                    $newRecord->set('usuar', $dato['usuar']);
                    $newRecord->set('cod_exp', $dato['cod_exp']);
                    $newRecord->set('api_estado', $dato['api_estado']);
                    $table->writeRecord();
                }
            }

            $table->save()->close();
            Responsables::where('estadodbf', 1)->update(['estadodbf' => 0]);
        } catch (Exception $e) {
        return response()->json(['message' => 'Excepción capturada: '+  $e->getMessage()]);
        }

    }
    protected function editarOficina(){
        try {
            $datos = Oficinas::where('estadodbf', 1)->get();
            $datosMap = [];
            foreach ($datos as $dato) {
                $datosMap[$dato->codofic . '|' . $dato->unidad] = [
                    'entidad'=>$dato->entidad,
                    'unidad'=>$dato->unidad,
                    'codofic'=>$dato->codofic,
                    'nomofic'=>$dato->nomofic,
                    'observ'=>$dato->observaciones,
                    'feult'=>$dato->feult,
                    'usuar'=>$dato->usuar,
                    'api_estado'=>$dato->api_estado,
                ];
            }

            $table = new TableEditor(public_path('vsiaf/dbfs/oficina.DBF'), ['encoding' => 'cp1252']);
            $procesados = [];
            while ($record = $table->nextRecord()) {
                $codofic = $record->get('codofic');
                $unidad = $record->get('unidad');
                $key =  $codofic . '|' .$unidad;
                if (isset($datosMap[$key])) {
                    $dato = $datosMap[$key];
                    $record->set('nomofic', $dato['nomofic']);
                    $record->set('api_estado', $dato['api_estado']);
                    $record->set('observ', $dato['observ']);
                    $table->writeRecord();
                    $procesados[$key] = true;
                }
            }
            foreach ($datosMap as $key => $dato) {
                if (!isset($procesados[$key])) {
                    $newRecord = $table->appendRecord();
                    $newRecord->set('entidad', $dato['entidad']);
                    $newRecord->set('unidad', $dato['unidad']);
                    $newRecord->set('codofic', $dato['codofic']);
                    $newRecord->set('nomofic', $dato['nomofic']);
                    $newRecord->set('observ', $dato['observ']);
                    $newRecord->set('feult', $dato['feult']);
                    $newRecord->set('usuar', $dato['usuar']);
                    $newRecord->set('api_estado', $dato['api_estado']);
                    $table->writeRecord();
                }
            }

            $table->save()->close();
            Oficinas::where('estadodbf', 1)->update(['estadodbf' => 0]);
        } catch (Exception $e) {
        return response()->json(['message' => 'Excepción capturada: '+  $e->getMessage()]);
        }

    }
}
