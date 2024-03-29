@php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);
@endphp
{{-- DASHBOARD --}}
@php
$class = '';

if ($controller == 'HomeController') {
$class = 'active';
}
@endphp

<li class="nav-item {{ $class }}">
    <a href="{{ route('home') }}" class="nav-link ">
        <i class="fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

{{-- FRETE --}}
@php
$class = '';

if ($controller == 'FreightsController') {
$class = 'active';
}
@endphp

<li class="nav-item {{ $class }}">
    <a href="{{ route('freights.index') }}" class="nav-link ">
        <i class="fas fa-motorcycle"></i>
        <p>Fretes</p>
    </a>
</li>

{{-- ADICIONAIS --}}
@php
    $class = '';

    if ($controller == 'AdditionalsController') {
    $class = 'active';
    }
@endphp
<li class="nav-item {{ $class }}">
    <a href="{{ route('additionals.index') }}" class="nav-link ">
        <i class="fas fa-plus"></i>
        <p>Adicionais</p>
    </a>
</li>

{{-- USUARIO --}}
@php
$class = 'collapsed';

if ($controller == 'UsersController' or $controller == 'ConfigurationsController') {
$class = 'active show';
}
@endphp
<li class="nav-item {{ $class }} ">
    <a data-toggle="collapse" href="#submenu">
        <i class="nav-icon fa fa-cog"></i>
        <p>Configurações</p>
        <span class="caret"></span>
    </a>
    <div class="{{ $class }} collapse collapsed " id="submenu">
        <ul class="nav nav-collapse">

         @can('index', \App\User::class)
         @php
         $class = '';

         if ($controller == 'UsersController' && $action <> 'profile')
         {
             $class = 'active';
         }
         @endphp
         <li class="{{ $class }}">
            <a href="{{ route('users.index') }}">
                <p class="sub-item">Usuários</p>
            </a>
        </li>

        @endcan

        @php
        $class = '';

        if ($controller == 'UsersController' && $action == 'profile')
        {
            $class = 'active';
        }
        @endphp
        <li class="{{ $class }}">
            <a href="{{ route('users.profile') }}">
                <p class="sub-item">Perfil</p>
            </a>
        </li>

         @php
             $class = '';

             if ($controller == 'ConfigurationsController' )
             {
                 $class = 'active';
             }
         @endphp
         <li class="{{ $class }}">
             <a href="{{ route('configurations.index') }}">
                 <p class="sub-item">Site</p>
             </a>
         </li>
    </ul>
</div>
</li>

</ul>
</li>
