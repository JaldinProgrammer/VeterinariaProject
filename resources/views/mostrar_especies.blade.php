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

<a href="{{route('register_specie')}}"><button type="button" class="btn btn-success btn-lg btn-block">Nueva especie</button></a>
<table class="table table-striped">
    <thead>
          <th>Especie</th>
          <th>Creado en</th>
          <th>Actializado</th>
    </thead>
    <tbody>
        @foreach ($species as $specie)
           <tr>
                <td>{{$specie->name}}</td>
                <td>{{($specie->created_at)? $specie->created_at->diffForHumans(): "-"}}</td>
                <td>{{($specie->updated_at)?$specie->updated_at->diffForHumans(): "-"}}</td>
                <td>
                    <a href="{{route('edit_specie',$specie->id)}}"><button type="button" class="btn btn-warning">Editar</button></a>
                    <a href="{{route('delete_specie',$specie->id)}}"><button type="button" class="btn btn-danger" onclick="return confirm('Seguro que quiere borrar esta especie?')">Borrar</button></a>                 
                </td>
           </tr> 
        @endforeach
    </tbody>
</table>
<div class="table table-striped">{{$species->links()}}</div>

@endsection