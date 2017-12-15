@extends('layouts.base')

@section('content')

    <h1 class="h1">Insertar Obra</h1>
    <hr>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <form action="addfuncion" method="post">
        
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input name="fecha" size="16" type="text" value="2012-06-15" readonly class="form_datetime form-control col-md-6" aria-describedby="date">
        </div>
        <label for="tipo">Seleccionar la obra que pertenece</label>
        <select name="puesta" id="puesta">
            @foreach($puestaobras as $puestaobra)
                <option value="{{$puestaobra->id}}">{{$puestaobra->nombre}}</option>
            @endforeach
        </select>
        
        </div>
        <button id="btn" type="submit" class="btn btn-outline-primary">Enviar</button>
        <a href="/leitmotiv/public/" class="btn btn-outline-primary"> volver</a>
    </form> </div>
        
    </div>

    <script>
        $(".form_datetime").datetimepicker({dateFormat: "yy-mm-dd",
    timeFormat:  "hh:mm:ss"});
    </script>
    
@endsection