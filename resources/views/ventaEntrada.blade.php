@extends('layouts.base')

@section('content')

    <h1 class="h1">Venta Entrada</h1>
    <hr>
    <table class="table table-striped table-hover table-bordered sample_editable_1" id="sample_editable_1">
        <thead>
        <tr>
            <th>
                Teatro
            </th>
            <th>
                Obra
            </th>
            <th>
                Funcion
            </th>
            <th>
                Disponibilidad
            </th>
            <th>
                Accion
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($obras as $obra)
            <tr>
                <td>
                    {{ $obra->NombreTeatro }}
                </td>
                <td>
                    {{ $obra->NombreObra }}
                </td>
                <td>
                    {{ $obra->fecharealizacion }}
                </td>
                <td>
                    {{ $obra->Disponibilidad }}
                </td>
                <td>
                    <form action="venderentrada" method="GET">
                        <input type="hidden" name="idPuuesta" value="{{$obra->puestaescenaId}}">
                        <input type="hidden" name="idteatro" value="{{$obra->idTeatro}}">
                        <input type="hidden" name="idobra" value="{{$obra->idObra}}">
                        <button id="btn" type="submit" class="btn btn-outline-primary">Enviar</button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
    </script>
@endsection