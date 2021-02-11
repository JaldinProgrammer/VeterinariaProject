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
          <th>Vacuna</th>
          <th>Inicio de tratamiento</th>
          <th>Fin del tratamiento</th>
    </thead>
    <tbody>
        @foreach ($treatments as $treatment)
           <tr>
                <td>{{$treatment->diagnostic}}</td>
                <td>{{($treatment->initdate)?$treatment->initdate->toFormattedDateString():"-"}}</td>
                <td>{{($treatment->enddate)?$treatment->enddate->toFormattedDateString():"-"}}</td>
           </tr> 
        @endforeach
    </tbody>
</table>
<div class="table table-striped">{{$treatments->links()}}</div>

@endsection