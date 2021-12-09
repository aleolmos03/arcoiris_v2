<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backup;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $backups = Backup::join('users', 'backups.created_by', '=', 'users.id')
        ->join('people', 'users.person_id', '=', 'people.id')
        ->select(
            'backups.id as id',
            'backups.file_name as backup',
            'backups.created_at as created_at',
            'people.name as name',
            'people.last_name as last_name',
            'users.email as userName'
        )
        ->orderBy('id','DESC');

        $total=$backups->count();
        $backups=$backups->paginate(7);

        return view('layouts.admin.Backups.index',compact('backups','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$dbhost = '127.0.0.1';
        $_db = 'sgiarcoiris5';
        $_user = 'root';
        $_pass = '';*/



       /*$command = 'c:\xampp\mysql\bin\mysqldump --opt -u '.$_user.' -p'.$_pass.' '.$_db.' > D:\test_sgiarcoiris3.sql';*/

        //$command = 'c:\xampp\mysql\bin\mysqldump --opt -u root sgiarcoiris3 > D:\BD_sgiarcoiris_'.date("Y-m-d-H-i-s").'.sql';
        //exec($command);

        /*$command = 'c:\xampp\mysql\bin\mysqldump --opt -u root sgiarcoiris5 > C:\Users\Alejandro\Desktop\BD_sgiarcoiris_'.date("Y-m-d-H-i-s").'.sql';
        exec($command);


        $backup = new Backup;
        $backup->name= 'BD_sgiarcoiris_'.date("Y-m-d-H-i-s");
        $backup->size= '145';
        $backup->user_id= auth()->id();
        $backup->save();

        Session::flash('message',' Backups Generado Correctamente');*/



        return redirect('/sistema/backups');//anda

        //die();

        //echo "backup ok";

        //echo exec("whoami");




       /* $dbhost = '127.0.0.1';
        $dbname = 'sgiarcoiris3';
        $dbuser = 'root';
        $dbpass = '';

        $backup_file = $dbname. "-" .date("Y-m-d-H-i-s"). ".sql";

        // comandos a ejecutar
        $commands = array(
                "mysqldump --opt -h $dbhost -u $dbuser -p$dbpass -v $dbname > $backup_file",
              "bzip2 $backup_file"
        );

        // ejecución y salida de éxito o errores
        foreach ( $commands as $command ) {
                system($command,$output);
                echo $output;
        }
        //Introduzca aquí la información de su base de datos y el nombre del archivo de /*copia de seguridad.
        $mysqlDatabaseName ='sgiarcoiris3';
        $mysqlUserName ='root';
        $mysqlPassword ='';
        $mysqlHostName ='127.0.0.1';
        $mysqlExportPath ='BD_SGIarcoiris.sql';

        //Por favor, no haga ningún cambio en los siguientes puntos
        //Exportación de la base de datos y salida del status
        $command='mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' --password="' .$mysqlPassword .'" ' .$mysqlDatabaseName .' > ' .$mysqlExportPath;
        exec($command,$output=array(),$worked);
        switch($worked){
        case 0:
        echo 'La base de datos <b>' .$mysqlDatabaseName .'</b> se ha almacenado correctamente en la siguiente ruta '.getcwd().'/' .$mysqlExportPath .'</b>';
        break;
        case 1:
        echo 'Se ha producido un error al exportar <b>' .$mysqlDatabaseName .'</b> a '.getcwd().'/' .$mysqlExportPath .'</b>';
        break;
        case 2:
        echo 'Se ha producido un error de exportación, compruebe la siguiente información: <br/><br/><table><tr><td>Nombre de la base de datos:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>Nombre de usuario MySQL:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>Contraseña MySQL:</td><td><b>NOTSHOWN</b></td></tr><tr><td>Nombre de host MySQL:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
        break;
        }*/




       // return view('vendor.admin.Backups.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dbhost = '127.0.0.1';
        $_db = 'sgi_arcoiris_v3';
        $_user = 'root';
        $_pass = '';
        $filename='\BD_sgiarcoiris_'.date("Y-m-d-H-i-s").'.sql';

       /*$command = 'c:\xampp\mysql\bin\mysqldump --opt -u '.$_user.' -p'.$_pass.' '.$_db.' > D:\test_sgiarcoiris3.sql';*/

        //$command = 'c:\xampp\mysql\bin\mysqldump --opt -u root sgiarcoiris3 > D:\BD_sgiarcoiris_'.date("Y-m-d-H-i-s").'.sql';
        //exec($command);

        $command = 'c:\xampp\mysql\bin\mysqldump --opt -u '.$_user.' '.$_db.' > C:\xampp\htdocs\SGI-Arcoiris_v2\SGI-Arcoiris\public\Backup'.$filename;
        exec($command);


        $backup = new Backup;
        $backup->file_name= 'BD_sgiarcoiris_'.date("Y-m-d-H-i-s");
        $backup->created_at= now();
        $backup->created_by= auth()->id();
        $backup->save();

        return response()->download(storage_path("app\public\Backup".$filename));
        die();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
