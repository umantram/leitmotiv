@extends('layouts.base')

@section('content')
    @if($venta =="true")
    <lable>Se vendio correctamente</lable>
    @else

        <lable>No se vendio correctamente</lable>
        @endif
    <a href="leitmotiv/public/">voler</a>
@endsection