@extends('layouts.base')

@section('content')

    <h1 class="h1">Confirmar Venta</h1>
    <hr>
    <form action="confirmarEntrada" method="post">
        <div class="form-group">
            <label>Tarifa:</label>
            <select name="tarifa" id="tarifa">
                @foreach($tarifas as $tarifa)
                    <option value="{{$tarifa->tarifaId}}">Numero de Butaca:{{$tarifa->NumeroButaca}} Precio:{{$tarifa->precio}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tarifa:</label>
            <select name="abonado" id="abonado">
                @foreach($abonados as $abonado)
                    <option value="{{$abonado->NumAbonado}}">Numero Abonado:{{$abonado->NumAbonado}}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="fechaventa" value="{{\Carbon\Carbon::now()}}">
        <input type="hidden" name="idPuuesta" value="{{$data->idPuuesta}}">
        <input type="hidden" name="idteatro" value="{{$data->idteatro}}">
        <input type="hidden" name="idobra" value="{{$data->idobra}}">
        <button type="submit" class="btn btn-primary">Aceptar</button>
    </form>
@endsection