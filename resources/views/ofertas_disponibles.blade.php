@extends('layouts.app')
@section('content')
<div><H1>Aprovecha nuestras ofertas</H1></div>
<br>
<div class="container-fluid" >
@foreach ($bargains as $bargain)
<div class="card" style="width: 28rem;">
@if($bargain->photo == NULL)
<img src="{{ asset('storage/Images/ImagenOferta.jpg')}}" class="img-fluid" alt="Responsive image" width="100" height="200">                  
@else
<img src="{{ asset($bargain->photo)}}" class="img-fluid" alt="Responsive image" width="60" height="70">                
@endif
  <div class="card-body">
    <h5 class="card-title">{{$bargain->title}}</h5>
    <p class="card-text">{{$bargain->body}}</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">{{"Comienza: ".$bargain->start->toFormattedDateString()}}</li>
    <li class="list-group-item">{{"Expira: ".$bargain->expiration->toFormattedDateString()}}</li>
  </ul>
  <small class="card-text" >{{" nota:".$bargain->note}}</small>
</div>
<br>
@endforeach
</div>
<div class="table table-striped">{{$bargains->links()}}</div>
@endsection