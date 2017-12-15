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
Route::post('/addobras', function () {
    //INSERT INTO `compañia`(`id`, `razonsocial`) VALUES ([value-1],[value-2])
    $data = (object) \Illuminate\Support\Facades\Input::All();

    $companias=\Illuminate\Support\Facades\DB::insert("INSERT INTO obra( nombre,tipo, costo,fechaestreno, idcompañia) 
VALUES ('$data->nombre','$data->tipo','$data->costo','$data->fechaestreno','$data->compania')");
    return view('addobras',compact('companias'));


/**

SQL para el Alta

INSERT INTO `obra`(`id`, `nombre`, `descripcion`, `prestigio`, `autor`, `costo`, `idcompañia`, `idtipoespectaculo`) VALUES ()

es lo mismo solo falta agregarle descripcion.


*/


});

Route::get('/listaObra', function () {
    $obras= (object) \Illuminate\Support\Facades\DB::select("SELECT obra.id as idObra, teatro.id as idTeatro, puestaescena.id as puestaescenaId, obra.nombre as NombreObra, puestaescena.fecharealizacion, teatro.nombre as NombreTeatro , (teatro.capacidad - COUNT(idObra)) as Disponibilidad FROM ventaentradas INNER JOIN puestaescena on ventaentradas.idpuestaescena = puestaescena.id INNER JOIN obra on puestaescena.idobra = obra.id INNER JOIN teatro on ventaentradas.idteatro = teatro.id GROUP BY obra.id, teatro.id , puestaescena.id , obra.nombre , puestaescena.fecharealizacion, teatro.nombre,leitmotiv.teatro.capacidad");
  //  dd($obras);
    return view('ventaEntrada',compact('obras'));


    /**
        
        Aca solo debe figurar la obra y las funciones nomas, vamos a sacarle la disponibilidad

        este es el SQL
        
        SELECT obra.nombre, funcion.fecharealizacion FROM `obra` INNER JOIN obrarealizapuestaescena on obra.id = obrarealizapuestaescena.id INNER JOIN puestaescena on puestaescena.id = obrarealizapuestaescena.idpuestaescena INNER JOIN celebra on puestaescena.id = celebra.idpuestaescena INNER JOIN funcion ON celebra.idfuncion = funcion.id


    */



});

Route::get('/venderentrada', function () {
    $data = (object) \Illuminate\Support\Facades\Input::All();
    $tarifas = (object) \Illuminate\Support\Facades\DB::select("SELECT tarifa.id as tarifaId,tarifa.numerobutaca as NumeroButaca, tarifa.precio as precio FROM tarifa");
    $abonados = (object) \Illuminate\Support\Facades\DB::select("SELECT id as NumAbonado FROM espectadorabono");
        //dd($data);
    return view('Venderentrada',compact('tarifas','abonados','data'));

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
    $venta = \Illuminate\Support\Facades\DB::insert("INSERT INTO ventaentradas (idtarifa, idpuestaescena, idteatro, idespectadorabono, fecha)
                                                                        VALUES ($data->tarifa,$data->idPuuesta,$data->idteatro,$data->abonado,'$data->fechaventa')");
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
    $totVentas = (object) \Illuminate\Support\Facades\DB::select("SELECT obra.nombre, Sum(tarifa.precio) as suma 
FROM `ventaentradas` INNER JOIN puestaescena on ventaentradas.idpuestaescena = puestaescena.id INNER JOIN obra on puestaescena.idobra = obra.id INNER JOIN tarifa on ventaentradas.idtarifa = tarifa.id 
WHERE `fecha` BETWEEN '2017-11-01' and '2017-11-30'
group by obra.nombre");
   // dd($totVentas);
    return view('totVentas',compact('totVentas'));
});

Route::get('/gastoObras', function () {
   $gastObras = (object) \Illuminate\Support\Facades\DB::select("SELECT obra.nombre, Sum(obrarecibemantenimiento.gasto) as suma FROM `obra` INNER JOIN obrarecibemantenimiento on obra.id = obrarecibemantenimiento.idobra WHERE obrarecibemantenimiento.periodoinicio BETWEEN '2017-11-01' and '2017-11-30' group by obra.nombre");
    //dd($gastObras);
    return view('gastObras',compact('gastObras'));
});

Route::get('/listaObras', function () {
   $obras = (object) \Illuminate\Support\Facades\DB::select("SELECT obra.nombre, obra.tipo, obra.costo, obra.fechaestreno, compañia.razonsocial FROM obra INNER JOIN compañia on obra.idcompañia = compañia.id");
    //dd($obras);
    return view('totObras',compact('obras'));

    /**
    Esta Consulta va aca Falta Agregar en la Vista la Columna Descripcion

    SELECT obra.nombre, obra.descripcion, obra.prestigio, obra.autor, obra.costo, compañia.razonsocial, tipoespectaculo.nombre ti FROM `obra` INNER JOIN compañia on obra.idcompañia = compañia.id INNER JOIN tipoespectaculo on obra.idtipoespectaculo = tipoespectaculo.id

    */

});

