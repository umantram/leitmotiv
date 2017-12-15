@extends('layouts.base')

@section('content')
    @if($companias =="true")
    <lable>Se agrego correctamente</lable>
    @else

        <lable>No se agregó correctamente</lable>
        @endif
    <a href="/leitmotiv/public/">voler</a>
@endsection