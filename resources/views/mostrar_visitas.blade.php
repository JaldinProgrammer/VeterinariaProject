@extends('layouts.app')
@section('content')
<div class="container">
<h5>{{"TRATAMIENTO: ".$treatment->diagnostic}}</h5>
<a href="{{route('register_visit',$treatment->id)}}"><button type="button" class="btn btn-success">Nueva visita</button></a>
</div>
        
<table class="table table-striped">
    <thead>
          <th>Descripcion</th>
          <th>Servicio</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Medico</th>
          <th>Opciones</th>
    </thead>
    <tbody>
        @foreach ($visits as $visit)
           <tr>
                <td>{{$visit->description}}</td>
                <td>{{$visit->service->name}}</td>
                <td>{{$visit->date->toFormattedDateString()}}</td>
                <td>{{$visit->time->diffForHumans()}}</td>
                <td>{{"Vet. ". $visit->user->name}}</td>
                <td>
                    <a href="{{route('edit_visit',$visit->id)}}"><button type="button" class="btn btn-warning">Editar</button></a>
                    <a href="{{route('delete_visit',$visit->id)}}"><button type="button" class="btn btn-danger" onclick="return confirm('Seguro que quiere eliminar esta visita?')">Borrar</button></a>                 
                </td>
           </tr> 
        @endforeach
    </tbody>
</table>
{{-- <div class="table table-striped">{{$visit->links()}}</div> --}}

@endsection