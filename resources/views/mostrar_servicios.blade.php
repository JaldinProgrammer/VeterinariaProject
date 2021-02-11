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

<a href="{{route('register_Services')}}"><button type="button" class="btn btn-success btn-lg btn-block">Nuevo servicio</button></a>
<table class="table table-striped">
    <thead>
          <th>Servicio</th>
          <th>Creacion</th>
          <th>Actualizado</th>
          <th>Estado</th>
          <th>Opciones</th>
    </thead>
    <tbody>
        @foreach ($services as $service)
           <tr>
                <td>{{$service->name}}</td>
                <td>{{($service->created_at)? $service->created_at->diffForHumans(): "-"}}</td>
                <td>{{($service->updated_at)?$service->updated_at->diffForHumans(): "-"}}</td>
                @php
                 $estado = ($service->available)? "Activo":"Inactivo" ;
                @endphp
                <td>{{$estado}}</td>
                <td>
                    <a href="{{route('edit_service',$service->id)}}"><button type="button" class="btn btn-warning">Editar</button></a>
                    <a href="{{route('delete_service',$service->id)}}"><button type="button" class="btn btn-danger" onclick="return confirm('Seguro que quiere eliminar esta visita?')">Desactivar</button></a>                 
                </td>
           </tr> 
        @endforeach
    </tbody>
</table>
<div class="table table-striped">{{$services->links()}}</div>
@endsection