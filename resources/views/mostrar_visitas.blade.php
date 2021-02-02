@extends('layouts.app')
@section('content')
<h1>{{$treatment->diagnostic}}</h1>
<a href="{{route('register_visit',$treatment->id)}}"><button type="button" class="btn btn-success">Nueva visita</button></a>        
<table class="table table-striped">
    <thead>
          <th>Descripcion</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Medico</th>
          <th>Opciones</th>
    </thead>
    <tbody>
        @foreach ($visits as $visit)
           <tr>
                <td>{{$visit->description}}</td>
                <td>{{$visit->date}}</td>
                <td>{{$visit->time}}</td>
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