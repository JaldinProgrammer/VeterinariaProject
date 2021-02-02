@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de nueva mascota') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update_pets',$pet->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $pet->nombre }}" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" accept="image/*" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ $pet->photo }}" >
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                            <div class="col-md-6">
                                <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ $pet->color }}">

                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de nacimiento') }}</label>

                            <div class="col-md-6">
                                <input id="birthdate" type="date"  class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ $pet->birthdate }}" >

                                @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deathdate" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de defuncion') }}</label>

                            <div class="col-md-6">
                                <input id="deathdate" type="date"  class="form-control @error('deathdate') is-invalid @enderror" name="deathdate" value="{{ old('deathdate') }}">

                                @error('deathdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Genero') }}</label>
                            <div class="col-md-6">
                               <input type="radio" name="gender" value="macho">Macho
                               <br><br>
                               <input type="radio" name="gender" value="hembra">Hembra
                               @error('gender')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                               @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="breed" class="col-md-4 col-form-label text-md-right">{{ __('Raza') }}</label>
                            <div class="col-md-6">
                                <select name="breed" id="breed">
                                    <option value="">--selecciona la especie--</option>
                                   @foreach ($breeds as $breed)                                        
                                   <option value="{{$breed->id}}">{{$breed->specie->name." -> ".$breed->name}}</option>                                    
                                   @endforeach 
                                </select>
                                @error('breed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="{{$pet->user_id}}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
