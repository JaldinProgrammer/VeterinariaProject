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
<table class="table table-striped">
    <thead>
          <th>Usuario</th>
          <th>Cuenta</th>
          <th>Accion</th>
          <th>Tabla</th>
          <th>Afectado</th>
          <th>Fecha</th>
          <th>Hace:</th>
    </thead> 
    <tbody>
        @foreach ($binnacles as $binnacle)
           <tr>
                <td>{{(($binnacle->user->customer == 1)? "Cliente. ":"Veterinario. ").$binnacle->user->name}}</td>
                <td>{{$binnacle->user->email}}</td>
                <td>{{$binnacle->action}}</td>
                <td>{{$binnacle->table}}</td>
                <td>{{$binnacle->entity}}</td>
                <td>{{$binnacle->created_at}}</td>
                <td>{{($binnacle->created_at)? $binnacle->created_at->diffForHumans(): "-"}}</td>
           </tr> 
        @endforeach
    </tbody>
</table>
<div class="table table-striped">{{$binnacles->links()}}</div>

@endsection