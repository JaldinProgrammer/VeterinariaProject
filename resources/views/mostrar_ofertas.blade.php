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

<a href="{{route('bargainForm')}}"><button type="button" class="btn btn-success btn-lg btn-block">Nuevo oferta</button></a>
<table class="table table-striped">
    <thead>
          <th>Titulo</th>
          <th>Foto</th>
          <th>Contenido</th>
          <th>Fecha Inicio</th>
          <th>Fecha Expiracion</th>
          <th>Nota</th>
          <th>Hecho por</th>
    </thead>
    <tbody>
        @foreach ($bargains as $bargain)
           <tr>
                <td>{{$bargain->title}}</td>
                            @if($bargain->photo == NULL)
                            <td><img src="{{asset('imagenes/ImagenOferta.png')}}" class="img-fluid" alt="Responsive image" width="100" height="200">
                            </td>      
                            @else
                            <td><img src="{{ asset($bargain->photo)}}" class="img-fluid" alt="Responsive image" width="60" height="70">
                            </td>
                            @endif
                <td>{{$bargain->body}}</td>
                <td>{{$bargain->start->toFormattedDateString()}}</td>
                <td>{{$bargain->expiration->toFormattedDateString()}}</td>
                <td>{{$bargain->note}}</td>
                <td>{{"vet. ".$bargain->user->name}}</td>
                 <td>
                   <a href="{{route('edit_bargain',$bargain->id)}}"><button type="button" class="btn btn-success">Editar</button></a>
                </td>
                 <td>
                   <a href="{{route('destroy_bargain',$bargain->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
                </td>
           </tr> 
        @endforeach
    </tbody>
</table>
<div class="table table-striped">{{$bargains->links()}}</div>
@endsection