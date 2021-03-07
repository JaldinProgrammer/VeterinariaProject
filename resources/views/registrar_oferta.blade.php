@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de nueva oferta') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('create_bargain') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- title --}}
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Titulo') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" >
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- photo --}}
                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" accept="image/*" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" >
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- body --}}
                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Contenido') }}</label>
                            <div class="col-md-6">
                                <input id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ old('body') }}" >
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- note --}}
                        <div class="form-group row">
                            <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Nota') }}</label>
                            <div class="col-md-6">
                                <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note') }}" >
                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                            {{-- fecha Inicio --}}
                            <div class="form-group row">
                                <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Inicio de la oferta') }}</label>
                                <div class="col-md-6">
                                    <input id="start" type="date"  class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}">
    
                                    @error('start')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- fecha fin --}}
                            <div class="form-group row">
                                <label for="expiration" class="col-md-4 col-form-label text-md-right">{{ __('Fin del tratamiento') }}</label>
                                <div class="col-md-6">
                                    <input id="expiration" type="date"  class="form-control @error('expiration') is-invalid @enderror" name="expiration" value="{{ old('expiration') }}">
                                    @error('expiration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>     
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">                           
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Publicar') }}
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