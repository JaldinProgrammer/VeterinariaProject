<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Veterinaria Vida Documentos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    
</head>
<body>
    <h5 >Veterinaria vida </h5>
    <div class="card">
        <div class="card-body">
            <br>
            <h5 class="card-title">Documento: Historial clinico </h5>
            <p class="card-text">Mascota: {{$pet->nombre}} </p>
            <p class="card-text">Dueño: {{$pet->user->name}} </p>
            <p class="card-text">Nacimiento: {{$pet->birthdate}} </p>
            <p class="card-text">Genero: {{$pet->breed->name}} </p>
            <br>
            <a href="https://veterinariavida1sistemas.herokuapp.com/" target="_blank" class="btn btn-primary">{{"Visitanos <3"}} </a>
        </div>
    </div>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col" >#</th>
                <th scope="col" >Diagnostico</th>
                <th scope="col">Inicio de tratamiento</th>
                <th scope="col">Fin del tratamiento</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($treatments as $treatment)
                <tr>
                    <th scope="row">{{$treatment->id}}</th>
                    <td>{{$treatment->diagnostic}}</td>
                    <td>{{($treatment->initdate)?$treatment->initdate->toFormattedDateString():"-"}}</td>
                    <td>{{($treatment->enddate)?$treatment->enddate->toFormattedDateString():"-"}}</td>
                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>