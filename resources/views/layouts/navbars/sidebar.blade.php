<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-10" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('argon') }}/img/brand/logop.png" width="100" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Bem vinda(o)!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Meu Perfil') }}</span>
                    </a>
                    <a href="{{ route('settings.show') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{__('Configurações')}}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Sair') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('dashboard.index') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                @can('view layouts')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">
                        <i class="ni ni-tv-2" style="color:#4B4A67;"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                @endcan
                <!-- Users -->
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-users" data-toggle="collapse" role="button" aria-controls="navbar-users">
                        <i class="fas fa-users" style="color:#4B4A67;"></i>
                        <span class="nav-link-text">{{ __('Usuários') }}</span>
                    </a>
                    <div class="collapse" id="navbar-users">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item" style="color:#4B4A67;">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('Meu Perfil') }}
                                </a>
                            </li>
                            @can('view layouts')
                            @can('view users')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    {{ __('Gerenciar Usuários') }}
                                </a>
                            </li>
                            @endcan
                            @can('view roles')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('roles.index') }}">
                                    {{ __('Gerenciar Permissões') }}
                                </a>
                            </li>
                            @endcan
                            @endcan
                        </ul>
                    </div>
                </li>

                <!-- Hotels-->
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-hotel" data-toggle="collapse" role="button" aria-controls="navbar-hotel">
                        <i class="fa fa-building" style="color:#4B4A67;"></i> {{ __('Hotéis') }}
                    </a>
                    <div class="collapse" id="navbar-hotel">
                        <ul class="nav nav-sm flex-column">
                            @can('view hotels')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('hotel.index') }}">
                                    {{ __('Listar Hotéis') }}
                                </a>
                            </li>
                            @endcan
                            @can('view layouts')
                            @can('create hotels')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('hotel.create') }}">
                                    {{ __('Adicionar Hotel') }}
                                </a>
                            </li>
                            @endcan
                            @endcan
                        </ul>
                    </div>
                </li>

                <!-- Currency -->
                @can('manage currencies')
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-currency" data-toggle="collapse" role="button" aria-controls="navbar-currency">
                        <i class="fa fa-money-bill-alt" style="color:#4B4A67;"></i> {{ __('Moedas') }}
                    </a>
                    <div class="collapse" id="navbar-currency">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('currency.index') }}">
                                    {{ __('Listar Moedas') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('currency.create') }}">
                                    {{ __('Adicionar Moeda') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link" href="#navbar-reservations" data-toggle="collapse" role="button" aria-controls="navbar-reservations">
                        <i class="fa fa-archive" style="color:#4B4A67;"></i> {{ __('Reservas') }}
                    </a>
                    <div class="collapse" id="navbar-reservations">
                        <ul class="nav nav-sm flex-column">
                            @can('view layouts')
                            <li class="nav-item">

                                @can('view reservations')
                                <a class="nav-link" href="{{ route('reservations.index') }}">
                                    {{ __('Listar Reservas') }}
                                </a>
                                @endcan
                                @can('view reservation reports')
                                <a class="nav-link" href="{{ route('reservationsError.error') }}">
                                    {{ __('Listar Reservas Sem Quartos') }}
                                </a>
                                @endcan
                            </li>

                            <li class="nav-item">
                                @can('view reservation reports')
                                <a class="nav-link" href="{{ route('reservationReports.index') }}">
                                    {{ __('Listar Reservas não comunicadas') }}
                                </a>
                                @endcan
                            </li>

                            <li class="nav-item">
                                @can('view reservation reports')
                                <a class="nav-link" href="{{ route('reservationsUpdate.update') }}">
                                    {{ __('Listar Reservas editadas') }}
                                </a>
                                @endcan
                            </li>

                            <li class="nav-item">
                                @can('view reservation sources')
                                <a class="nav-link" href="{{ route('reservationSource.index') }}">
                                    {{ __('Fontes da Reserva') }}
                                </a>
                                @endcan
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('calculatorTariff.index') }}">
                        <i class="fa fa-calculator" style="color:#4B4A67;"></i> {{ __('Calcular Tarifa') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('activityLog.index') }}">
                        <i class="fa fa-clipboard-list" style="color:#4B4A67;"></i> {{ __('Registro de Atividades') }}
                    </a>
                </li>

                <li class="nav-item">
                    @can('view rates reports')
                    <a class="nav-link" href="{{ route('rateErrorReport.index') }}">
                        <i class="fas fa-chart-bar" style="color:#4B4A67;"></i> {{ __('Relatório de Tarifas') }}
                    </a>
                    @endcan
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('thematicTags.index') }}">
                        <i class="fa fa-tag" style="color:#4B4A67;"></i> {{ __('Tags Temáticas') }}
                    </a>
                </li>
                @can('view layouts')
                <li class="nav-item">
                    <a target="_blank" class="nav-link" href="/horizon" role="button" aria-controls="navbar-hotel">
                        <i class="fa fa-tasks" style="color:#4B4A67;"></i> {{ __('Fila de Tarefas') }}
                    </a>
                </li>
                @endcan

            </ul>
        </div>
    </div>
</nav>