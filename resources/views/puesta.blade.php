@extends('layouts.base')

@section('content')

    <h1 class="h1">Insertar Obra</h1>
    <hr>
    <div class="row">
        <div class="col-md-12 col-lg-12"><form action="addpuesta" method="post">
        
        <div class="form-group">
            <label for="costo">Nombre</label>
            <input name="nombre" type="text" class="form-control col-md-6" id="nombre" aria-describedby="emailHelp" placeholder="ingresar nombre de la obra">
        </div>
        <label for="tipo">Seleccionar la obra que pertenece</label>
        <select name="obra" id="obra">
            @foreach($obras as $obra)
                <option value="{{$obra->id}}">{{$obra->nombre}}</option>
            @endforeach
        </select>
        </div>
        <button id="btn" type="submit" class="btn btn-outline-primary">Enviar</button>
        <a href="/leitmotiv/public/" class="btn btn-outline-primary"> volver</a>
    </form> </div>
        
    </div>
    
@endsection