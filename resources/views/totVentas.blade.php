@extends('layouts.base')

@section('content')

    <h1 class="h1">Total de Venta de Entradas</h1>
    <hr>
    <table class="table table-striped table-hover table-bordered sample_editable_1" id="sample_editable_1">
        <thead>
        <tr>
            <th>
                Nombre
            </th>
            <th>
                Suma
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($totVentas as $totVenta)
            <tr>
                <td>
                    {{ $totVenta->nombre}}
                </td>
                <td>
                    {{ $totVenta->suma }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
    </script>
@endsection