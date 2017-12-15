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


//$someVariable = Input::get("some_variable");

//$results = DB::select( DB::raw("SELECT * FROM some_table WHERE some_col = '$someVariable'") );

/*$users = DB::table('users')
->select(DB::raw("
  name,
  surname,
  (CASE WHEN (gender = 1) THEN 'M' ELSE 'F' END) as gender_text")
);*/

/*$users = DB::table('users')
    ->select(DB::raw('count(*) as user_count, status'))
    ->where('status', '<>', 1)
    ->groupBy('status')
    ->get();*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ticket', function () {
    return view('entrada');
});

Route::get('/obras', function () {
    $companias=\Illuminate\Support\Facades\DB::select('select * from compañia');
    return view('obras',compact('companias'));

    /**
    
    Falta que se liste el tipo de espectaculo

    SELECT * FROM `tipoespectaculo` para poder hacer el alta

    */



});
//ya
Route::post('/addobras', function () {
    //INSERT INTO `compañia`(`id`, `razonsocial`) VALUES ([value-1],[value-2])
    $data = (object) \Illuminate\Support\Facades\Input::All();

    $companias=\Illuminate\Support\Facades\DB::insert("INSERT INTO obra(nombre,descripcion,prestigio,autor,costo,idcompañia,idtipoespectaculo) 
VALUES ('$data->nombre','$data->descripcion','$data->prestigio','$data->autor','$data->costo','$data->compania','$data->tipo')");
    return view('addobras',compact('companias'));


/**

SQL para el Alta

INSERT INTO `obra`(`id`, `nombre`, `descripcion`, `prestigio`, `autor`, `costo`, `idcompañia`, `idtipoespectaculo`) VALUES ()

es lo mismo solo falta agregarle descripcion.


*/


});
Route::post('/addpuesta', function () {
    //INSERT INTO `compañia`(`id`, `razonsocial`) VALUES ([value-1],[value-2])
    $data = (object) \Illuminate\Support\Facades\Input::All();

    $companias=\Illuminate\Support\Facades\DB::insert("INSERT INTO puestaescena(nombre,idobra) 
VALUES ('$data->nombre','$data->obra')");
    return view('addobras',compact('companias'));


/**

SQL para el Alta

INSERT INTO `obra`(`id`, `nombre`, `descripcion`, `prestigio`, `autor`, `costo`, `idcompañia`, `idtipoespectaculo`) VALUES ()

es lo mismo solo falta agregarle descripcion.


*/


});
Route::post('/addfuncion', function () {
    //INSERT INTO `compañia`(`id`, `razonsocial`) VALUES ([value-1],[value-2])
    $data = (object) \Illuminate\Support\Facades\Input::All();

    $companias=\Illuminate\Support\Facades\DB::insert("INSERT INTO funcion(fecharealizacion,idpuestaescena) 
VALUES ('$data->fecha','$data->puesta')");
    return view('addobras',compact('companias'));


/**

SQL para el Alta

INSERT INTO `obra`(`id`, `nombre`, `descripcion`, `prestigio`, `autor`, `costo`, `idcompañia`, `idtipoespectaculo`) VALUES ()

es lo mismo solo falta agregarle descripcion.


*/


});
Route::get('/puesta', function () {
    
    $obras=\Illuminate\Support\Facades\DB::select("SELECT obra.id, obra.nombre from obra");
    //dd($obras);
    return view('puesta',compact('obras'));


/**

SQL para el Alta

INSERT INTO `obra`(`id`, `nombre`, `descripcion`, `prestigio`, `autor`, `costo`, `idcompañia`, `idtipoespectaculo`) VALUES ()

es lo mismo solo falta agregarle descripcion.


*/


});
Route::get('/funcion', function () {
    
    $puestaobras=\Illuminate\Support\Facades\DB::select("SELECT puestaescena.id, puestaescena.nombre from puestaescena");
    //dd($obras);
    return view('funcion',compact('puestaobras'));


/**

SQL para el Alta

INSERT INTO `obra`(`id`, `nombre`, `descripcion`, `prestigio`, `autor`, `costo`, `idcompañia`, `idtipoespectaculo`) VALUES ()

es lo mismo solo falta agregarle descripcion.


*/


});

Route::get('/listaObra', function () {
    $obras= (object) \Illuminate\Support\Facades\DB::select("SELECT obra.id, obra.nombre,funcion.id as funcionId, funcion.fecharealizacion from obra INNER JOIN puestaescena on obra.id = puestaescena.idobra INNER JOIN funcion on funcion.idpuestaescena = puestaescena.id");
    //dd($obras);
    return view('ventaEntrada',compact('obras'));


    /**
        
        Aca solo debe figurar la obra y las funciones nomas, vamos a sacarle la disponibilidad

        este es el SQL

        SELECT obra.id, obra.nombre, funcion.fecharealizacion from obra INNER JOIN puestaescena on obra.id = puestaescena.idobra INNER JOIN funcion on funcion.idpuestaescena = puestaescena.id


    */



});

Route::get('/venderentrada', function () {
    $data = (object) \Illuminate\Support\Facades\Input::All();
    //dd($data);
    $tarifas = (object) \Illuminate\Support\Facades\DB::select("SELECT tarifa.id as tarifaId,tarifa.precio as precio FROM tarifa INNER JOIN funcion on tarifa.idfuncion = funcion.id where funcion.id=".$data->idfuncion);
    $abonados = (object) \Illuminate\Support\Facades\DB::select("SELECT id as NumAbonado FROM espectadorabono");
    $funciones = (object) \Illuminate\Support\Facades\DB::select("SELECT id,fecharealizacion FROM funcion");
    $butacas = (object) \Illuminate\Support\Facades\DB::select("SELECT id,numbutaca FROM butacas");
        //dd($data);
    return view('Venderentrada',compact('tarifas','abonados','funciones','data','butacas'));

    /**

    La variable tarifa cambia el sql

    Se tiene que listar tambien las funciones y despues elejir la tarifa (le mejor seria que se listen las tarifas en base a la funcion)

    Tarifa: 
    SELECT `id`, `precio` FROM `tarifa`
    
    Funcion: 
    SELECT `id`, `fecharealizacion` FROM `funcion` 
    
    Alternativo

    Funcion con Tarifa:
    SELECT tarifa.id, tarifa.precio, funcion.fecharealizacion FROM `tarifa` INNER JOIN funcion on tarifa.idfuncion = funcion.id


    */

});
Route::post('/confirmarEntrada', function () {
    $data = (object) \Illuminate\Support\Facades\Input::All();
    $venta = \Illuminate\Support\Facades\DB::insert("INSERT INTO ventaentradas (idtarifa,idbutaca,idespectadorabono, fecha)
                                                                        VALUES ($data->tarifa,$data->butaca,$data->abonado,'$data->fechaventa')");
    //dd($data);
    return view('ventasrealizada',compact('venta'));

    /**
    En esta parte hay que sacar idpuestaenescena y agregar idbutaca
    Se tiene que generar un dropdown de las butacas

    Este es el SQL para el alta de VentaEntradas
    INSERT INTO `ventaentradas`(`idtarifa`, `idbutaca`, `idespectadorabono`, `fecha`) VALUES ()



    */

});

Route::get('/totVentasEntradas', function () {
    $totVentas = (object) \Illuminate\Support\Facades\DB::select("SELECT funcion.fecharealizacion, sum(tarifa.precio) as suma FROM `ventaentradas` INNER JOIN tarifa on ventaentradas.idtarifa = tarifa.id INNER JOIN funcion on tarifa.idfuncion = funcion.id WHERE `fecharealizacion` BETWEEN '2017-12-01' and '2017-12-30' GROUP BY funcion.fecharealizacion
");
   // dd($totVentas);
    return view('totVentas',compact('totVentas'));
});





Route::get('/gastoObras', function () {
   $gastObras = (object) \Illuminate\Support\Facades\DB::select("SELECT obra.nombre, sum(obrarecibemantenimiento.gasto) as suma from obra INNER join puestaescena ON puestaescena.idobra = obra.id INNER JOIN obrarecibemantenimiento on obrarecibemantenimiento.idpuestaescena = puestaescena.id where obrarecibemantenimiento.periodoinicio BETWEEN '2017-12-01' and '2017-12-30' GROUP BY obra.nombre
");
    //dd($gastObras);
    return view('gastObras',compact('gastObras'));
});
//ya
Route::get('/listaObras', function () {
   $obras = (object) \Illuminate\Support\Facades\DB::select("SELECT obra.nombre, obra.descripcion, obra.prestigio, obra.autor, obra.costo, compañia.razonsocial, obra.idtipoespectaculo FROM obra INNER JOIN compañia on obra.idcompañia = compañia.id");
    //dd($obras);
    return view('totObras',compact('obras'));

    /**
    Esta Consulta va aca Falta Agregar en la Vista la Columna Descripcion

    SELECT obra.nombre, obra.descripcion, obra.prestigio, obra.autor, obra.costo, compañia.razonsocial, tipoespectaculo.nombre FROM `obra` INNER JOIN compañia on obra.idcompañia = compañia.id INNER JOIN tipoespectaculo on obra.idtipoespectaculo = tipoespectaculo.id

    */

});

