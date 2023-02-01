@extends('layouts.app', ['title' => __('User Create')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Adicionar Usuário')
    ])   
    <div class="container-fluid mt--7">
    	<div class="row">
    		<div class="col">
    			<div class="card shadow">
    				<div class="card-header border-0">
    					<div class="row align-items-center">
    						<div class="col-8">
                                <h3 class="mb-0">{{ __('Adicione um usuário') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar à lista') }}</a>
                            </div>
    					</div>
    				</div>

    				<div class="card-body">
    					<form method="post" action="{{ route('user.store') }}" autocomplete="off">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Informações básicas') }}</h6>
                            <div class="pl-lg-4">
                            	<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nome') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nome') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Senha') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Senha') }}" value="" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirmar Senha') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirmar Senha') }}" value="" required>
                                </div>

                                <!-- Roles Form Input -->
                                <div class="form-group @if ($errors->has('roles')) has-error @endif">
                                    {!! Form::label('roles[]', 'Roles') !!}
                                    {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control', 'multiple']) !!}
                                    @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Criar Usuário') }}</button>
                                </div>
                            </div>
                        </form>
    				</div>
    			</div>
    		</div>
    	</div>
    	@include('layouts.footers.auth')
    </div>
@endsection