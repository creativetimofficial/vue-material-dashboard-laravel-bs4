<div class="card panel-default">
    <div class="card-header" role="tab" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" aria-expanded="true" aria-controls="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
                {{ $title }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </a>
        </h4>
    </div>
    <div id="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <div class="card-body">
            <div class="row">
                @foreach($permissions as $perm)
                    <?php
                    $per_found = null;

                    if( isset($role) ) {
                        $per_found = $role->hasPermissionTo($perm->name);
                    }

                    if( isset($user)) {
                        $per_found = $user->hasDirectPermission($perm->name);
                    }
                    ?>

                    <div class="col-md-3">
                        <div class="checkbox">
                            <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            @can('edit roles')
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary mb-2 float-right']) !!}
            @endcan
        </div>
    </div>
</div>
