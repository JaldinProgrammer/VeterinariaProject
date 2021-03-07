@extends('layouts.app')
@section('content')

@if ($errors->count() > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif 
<div class="container">
    <h1>{{"Historial Clinico de : ".$pet->nombre}}</h1>
    <a href="{{route('register_treatment',$pet->id)}}"><button type="button" class="btn btn-success">Nuevo tratamiento</button></a>        
    <a href="{{route('print_Historial',$pet->id)}}" target="_blank"><button type="button" class="btn btn-info">Imprimir Historial Clinico</button></a>        
</div>
<table class="table table-striped">
    <thead>
          <th>Diagnostico</th>
          <th>Inicio de tratamiento</th>
          <th>Fin del tratamiento</th>
          <th>Opciones</th>
          <th>Reservas</th>
    </thead>
    <tbody>
        @foreach ($treatments as $treatment)
           <tr>
                <td>{{$treatment->diagnostic}}</td>
                <td>{{($treatment->initdate)?$treatment->initdate->toFormattedDateString():"-"}}</td>
                <td>{{($treatment->enddate)?$treatment->enddate->toFormattedDateString():"-"}}</td>
                <td>
                    <a href="{{route('show_visits',$treatment->id)}}"><button type="button" class="btn btn-info">Visitas</button></a>
                    <a href="{{route('edit_treatment',$treatment->id)}}"><button type="button" class="btn btn-warning">Configuracion</button></a>
                    @if(Auth::user()->admin == 1)  
                    <a href="{{route('destroy_treatment',$treatment->id)}}"><button type="button" class="btn btn-danger"onclick="return confirm('Seguro que quiere eliminar este tratamiento?')">borrar</button></a>
                    @endif
                </td>
                <td>
                    <a href="{{route('see_all_notification',$treatment->id)}}"><button type="button" class="btn btn-success">ver notificaciones</button></a>  
                </td>
           </tr> 
        @endforeach
    </tbody>
</table>
<div class="table table-striped">{{$treatments->links()}}</div>

@endsection