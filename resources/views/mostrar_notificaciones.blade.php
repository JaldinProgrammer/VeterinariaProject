@extends('layouts.app')
@section('content')


<a href="{{route('register_notification', $treatment->id)}}"><button type="button" class="btn btn-success btn-lg btn-block">Nueva notificacion</button></a>
<table class="table table-striped">
    <thead>
          <th>mensaje</th>
          <th>fecha</th>
          <th>creado en</th>
          <th>actualizado en</th>
          <th>Opciones</th>
    </thead>
    <tbody>
        @foreach ($treatment->notifications as $notification)
           <tr>
                <td>{{$notification->message}}</td>
                <td>{{$notification->eventDate->diffForHumans()}}</td>
                <td>{{($notification->created_at)? $notification->created_at->diffForHumans(): "-"}}</td>
                <td>{{($notification->updated_at)?$notification->updated_at->diffForHumans(): "-"}}</td>
                <td>
                    <a href="{{ route('edit_notification',$notification->id)}}"><button type="button" class="btn btn-warning">Editar</button></a>
                    <a href="{{ route('delete_notification',$notification->id)}}"><button type="button" class="btn btn-danger" onclick="return confirm('Seguro que quiere eliminar esta notificacion?')">Desactivar</button></a>                 
                </td>
           </tr> 
        @endforeach
    </tbody>
</table>
@endsection