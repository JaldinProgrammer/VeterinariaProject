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

<a href="{{route('register_Breed')}}"><button type="button" class="btn btn-success btn-lg btn-block">Nueva raza</button></a>
<table class="table table-striped">
    <thead>
          <th>raza</th>
          <th>descripcion</th>
          <th>especie</th>
    </thead>
    <tbody>
        @foreach ($breeds as $breed)
           <tr>
                <td>{{$breed->name}}</td>
                <td>{{$breed->description}}</td>
                <td>{{$breed->specie->name}}</td>
                <td>
                    <a href="{{route('edit_breed',$breed->id)}}"><button type="button" class="btn btn-warning">Editar</button></a>
                    <a href="{{route('delete_breed',$breed->id)}}"><button type="button" class="btn btn-danger" onclick="return confirm('Seguro que quiere borrar esta raza?')">Borrar</button></a>                 
                </td>
           </tr> 
        @endforeach
    </tbody>
</table>
<div class="table table-striped">{{$breeds->links()}}</div>
@endsection