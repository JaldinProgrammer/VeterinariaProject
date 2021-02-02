@extends('layouts.app')
@section('content')
<h1>{{"Historial Clinico de : ".$pet->nombre}}</h1>
<a href="{{route('register_treatment',$pet->id)}}"><button type="button" class="btn btn-success">Nuevo tratamiento</button></a>        
<table class="table table-striped">
    <thead>
          <th>Diagnostico</th>
          <th>Inicio de tratamiento</th>
          <th>Fin del tratamiento</th>
          <th>Opciones</th>
    </thead>
    <tbody>
        @foreach ($treatments as $treatment)
           <tr>
                <td>{{$treatment->diagnostic}}</td>
                <td>{{$treatment->initdate}}</td>
                <td>{{$treatment->enddate}}</td>
                <td>
                    <a href="{{route('show_visits',$treatment->id)}}"><button type="button" class="btn btn-info">Visitas</button></a>
                    <a href="{{route('edit_treatment',$treatment->id)}}"><button type="button" class="btn btn-warning">Configuracion</button></a>
                    @if(Auth::user()->admin == 1)  
                    <a href="{{route('destroy_treatment',$treatment->id)}}"><button type="button" class="btn btn-danger"onclick="return confirm('Seguro que quiere eliminar este tratamiento?')">borrar</button></a>
                    @endif
                </td>
           </tr> 
        @endforeach
    </tbody>
</table>
<div class="table table-striped">{{$treatments->links()}}</div>

@endsection