@extends('layouts.base')

@section('content')

    <h1 class="h1">Total de Venta de Entradas</h1>
    <hr>
    <table class="table table-striped table-hover table-bordered sample_editable_1" id="sample_editable_1">
        <thead>
        <tr>
            <th>
                Fecha Realizacion
            </th>
            <th>
                Total
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($totVentas as $totVenta)
            <tr>
                <td>
                    {{ $totVenta->fecharealizacion}}
                </td>
                <td>
                    {{ $totVenta->suma }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
<a href="/leitmotiv/public/" class="btn btn-outline-primary"> volver</a>
    <script>
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
    </script>
@endsection