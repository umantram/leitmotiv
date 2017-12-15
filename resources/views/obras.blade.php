@extends('layouts.base')

@section('content')

    <h1 class="h1">Insertar Obra</h1>
    <hr>
    <form action="addobras" method="post">
        <div class="form-group">
        <label for="tipo">Tipo Obra</label>
            <select name="tipo" id="tipo">
                <option value="comedia">comedia</option>
                <option value="terror">terror</option>
                <option value="drama">drama</option>
            </select>
        </div>
        <div class="form-group">
            <label for="costo">Nombre</label>
            <input name="nombre" type="text" class="form-control col-md-6" id="nombre" aria-describedby="emailHelp" placeholder="ingresar nombre de la obra">
        </div>
        <div class="form-group">
            <label for="costo">Costo</label>
            <input name="costo" type="text" class="form-control col-md-6" id="costo" aria-describedby="emailHelp" placeholder="ingresar costo de la obra">
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input name="fechaestreno" size="16" type="text" value="2012-06-15" readonly class="form_datetime form-control col-md-6" aria-describedby="date">
        </div>

        <div>
        <label for="tipo">Seleccionar a que compañía pertenece</label>
        <select name="compania" id="compania">
            @foreach($companias as $compania)
                <option value="{{$compania->id}}">{{$compania->razonsocial}}</option>
            @endforeach
        </select>
        </div>
        <button id="btn" type="submit" class="btn btn-outline-primary">Enviar</button>
    </form>
    <script>
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
    </script>
@endsection