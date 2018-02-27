<ul class="nav nav-sidebar">
  {!! HTML::auth_nav_li('admin.index', 'Inicio', 'home', null) !!}
  {!! HTML::auth_nav_li('admin.access', 'Roles y permisos', 'key', 'manage_access') !!}
  {!! HTML::auth_nav_li('admin.audit', 'Auditoría', 'briefcase', 'audit') !!}
  {!! HTML::auth_nav_li('admin.settings', 'Configuración', 'cogs', 'manage_settings') !!}
  {!! HTML::auth_nav_li('admin.support', 'Soporte', 'life-ring', 'superadmin') !!}
  <li>
    <a href="{{ route('admin.logout') }}"><i class="fa fa-fw fa-sign-out"></i> Salir</a>
  </li>
</ul>

{{-- <ul class="nav nav-sidebar">
  <li><a href="">Nav item</a></li>
  <li><a href="">Nav item again</a></li>
  <li><a href="">One more nav</a></li>
  <li><a href="">Another nav item</a></li>
  <li><a href="">More navigation</a></li>
</ul>
          
<ul class="nav nav-sidebar">
  <li><a href="">Nav item again</a></li>
  <li><a href="">One more nav</a></li>
  <li><a href="">Another nav item</a></li>
</ul> --}}