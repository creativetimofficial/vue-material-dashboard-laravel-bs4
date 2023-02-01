@extends('layouts.app', ['title' => __('Permissions Management')])

@section('content')
    @include('layouts.headers.cards')   
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h2 class="mb-0">{{ __('Permissões') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                              @can('create roles')
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roleModal">
									                <i class="fas fa-plus"></i> Criar Permissão
								                </button>
                              @endcan
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="accordion">
                        @forelse ($roles as $role)
                            {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update',  $role->id ], 'class' => 'mb-2']) !!}

                            @if($role->name === 'Admin')
                                @include('shared._permissions', [
                                              'title' => 'Permissões ' . $role->name,
                                              'options' => ['disabled'] ])
                            @else
                                @include('shared._permissions', [
                                              'title' => 'Permissões ' . $role->name,
                                              'model' => $role ])
                            @endif
                            
                            {!! Form::close() !!}
                        @empty
                            <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
                        @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        {!! Form::open(['method' => 'post']) !!}
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Criar Permissão</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group @if ($errors->has('name')) has-error @endif">
                {!! Form::label('name', 'Nome', ['class' => 'float-left']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome da Permissão']) !!}
                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
            </div>
          </div>
          <div class="modal-footer">
            {!! Form::submit('Criar Permissão', ['class' => 'btn btn-primary']) !!}
          </div>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
@endsection
