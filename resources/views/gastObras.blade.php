@extends('layouts.base')

@section('content')

    <h1 class="h1">Total Gasto de Obra</h1>
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
        @foreach ($gastObras as $gastObra)
            <tr>
                <td>
                    {{ $gastObra->nombre }}
                </td>
                <td>
                    {{ $gastObra->suma }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
    </script>
@endsection