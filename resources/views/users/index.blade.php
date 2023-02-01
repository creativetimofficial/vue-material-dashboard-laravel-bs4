@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Usuários') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                @can('create users')
                                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user-plus"></i>{{ __('Novo Usuário') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Nome') }}</th>
                                        <th scope="col">{{ __('Email') }}</th>
                                        <th scope="col">{{ __('Data Criação') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                @can('view users')
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                </td>
                                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="text-right">
                                                    @if ($user->id != auth()->id())
                                                        <form action="{{ route('user.destroy', $user) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            @can('edit users')
                                                                <a class="btn btn-primary" href="{{ route('user.edit', $user) }}"><i class="fa fa-pen"></i> {{ __('Editar') }}</a>
                                                            @endcan
                                                            @can('delete users')
                                                                <button type="button" class="btn btn-warning" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                    <i class="fa fa-trash"></i> {{ __('Deletar') }}
                                                                </button>
                                                            @endcan
                                                        </form>
                                                    @else
                                                        @can('edit users')
                                                            <a class="btn btn-primary" href="{{ route('profile.edit') }}"><i class="fa fa-pen"></i> {{ __('Editar') }}</a>
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endcan
                            </table>
                        </div>
                    </div>
                    {{$users->links()}}
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection