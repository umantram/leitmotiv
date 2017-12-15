@extends('layouts.base')

@section('content')

    <h1 class="h1">Venta Entrada</h1>
    <hr>
    <table class="table table-striped table-hover table-bordered sample_editable_1" id="sample_editable_1">
        <thead>
        <tr>
            <th>
                Obra
            </th>
            <th>
                Funcion
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
                    {{ $obra->nombre }}
                </td>
                <td>
                    {{ $obra->fecharealizacion }}
                </td>
                <td>
                    <form action="venderentrada" method="GET">
                        <input type="hidden" name="idfuncion" value="{{$obra->funcionId}}">
                        <button id="btn" type="submit" class="btn btn-outline-primary">Comprar</button>
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