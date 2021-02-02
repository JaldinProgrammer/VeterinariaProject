@extends('layouts.app')
@section('content')
<h1>{{"Historial clinico de : ".$pet->nombre}}</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de nueva mascota') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('create_treatment') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- diagnostico --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Diagnostico') }}</label>

                            <div class="col-md-6">
                                <input id="diagnostic" type="text" class="form-control @error('diagnostic') is-invalid @enderror" name="diagnostic" value="{{ old('diagnostic') }}" >
                                @error('diagnostic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- fecha Inicio --}}
                            <div class="form-group row">
                                <label for="initdate" class="col-md-4 col-form-label text-md-right">{{ __('Inicio del tratamiento') }}</label>
                                <div class="col-md-6">
                                    <input id="initdate" type="date"  class="form-control @error('initdate') is-invalid @enderror" name="initdate" value="{{ old('initdate') }}">
    
                                    @error('initdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- fecha fin --}}
                            <div class="form-group row">
                                <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __('Fin del tratamiento') }}</label>
                                <div class="col-md-6">
                                    <input id="enddate" type="date"  class="form-control @error('enddate') is-invalid @enderror" name="enddate" value="{{ old('enddate') }}">
                                    @error('enddate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>     
                        <input type="hidden" name="pet_id" value="{{$pet->id}}">                           
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection