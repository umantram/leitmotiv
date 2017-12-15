@extends('layouts.base')

@section('content')

    <h1 class="h1">Total de obras</h1>
    <hr>
    <table class="table table-striped table-hover table-bordered sample_editable_1" id="sample_editable_1">
        <thead>
        <tr>

            <th>
                Nombre
            </th>
            <th>
                Descripcion
            </th>
            <th>
                Tipo
            </th>
            <th>
                Costo
            </th>
            <th>
                razonsocial
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($obras as $obra)
            <tr>
                <td>
                    {{ $obra->nombre}}
                </td><td>
                    {{ $obra->descripcion}}
                </td>
                <td>
                    {{ $obra->idtipoespectaculo  }}
                </td>
                <td>
                    {{ $obra->costo }}
                </td>
                <td>
                    {{ $obra->razonsocial }}
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