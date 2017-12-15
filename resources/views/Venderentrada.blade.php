@extends('layouts.base')

@section('content')

    <h1 class="h1">Confirmar Venta</h1>
    <hr>
    <form action="confirmarEntrada" method="post">
        <div class="form-group">
            <label>Tarifa:</label>
            <select name="tarifa" id="tarifa">
            @foreach($tarifas as $tarifa)
                <option value="{{$tarifa->tarifaId}}">{{$tarifa->precio}}</option>
            @endforeach
        </select>
         <div class="form-group">
            <label>Numero de butaca:</label>
            <select name="butaca" id="butaca">
            @foreach($butacas as $butaca)
                <option value="{{$butaca->id}}">{{$butaca->numbutaca}}</option>
            @endforeach
        </select>
        
        </div>
        </div>
        <div class="form-group">
            <label>Abonado:</label>
            <select name="abonado" id="abonado">
                @foreach($abonados as $abonado)
                    <option value="{{$abonado->NumAbonado}}">Numero Abonado:{{$abonado->NumAbonado}}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="fechaventa" value="{{\Carbon\Carbon::now()}}">
        <button type="submit" class="btn btn-primary">Aceptar</button>
          <a href="/leitmotiv/public/" class="btn btn-outline-primary"> volver</a>

    </form>
@endsection