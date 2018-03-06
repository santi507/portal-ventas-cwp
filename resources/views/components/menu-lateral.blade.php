<ul class="nav nav-sidebar">

  {!! HTML::auth_nav_li('admin.index', 'Inicio', 'home', null) !!}
  <li>
    <a href="#vendedores" class="list-group-item" data-toggle="collapse" data-parent="#vendedores" style="background-color: #f5f5f5;color: #00a7cf">
      <i class="fa fa-users"></i> Vendedores
    </a>
  </li>
  <div class="collapse list-group-submenu list-group-submenu-1" id="vendedores">
    <li>
      <a href="{{ route('admin.sellers.shop') }}" class="list-group-item" data-parent="#vendedores">
        <i class="fa fa-angle-right"></i> Tienda
      </a>
    </li>
    <li>
      <a href="#" class="list-group-item" data-parent="#vendedores">
        <i class="fa fa-angle-right"></i> Call Center
      </a>
    </li>
    <li>
      <a href="#" class="list-group-item" data-parent="#vendedores">
        <i class="fa fa-angle-right"></i> Venta Directa
      </a>
    </li>
    <li>
      <a href="#" class="list-group-item" data-parent="#vendedores">
        <i class="fa fa-angle-right"></i> Promotores
      </a>
    </li>
    <li>
      <a href="#" class="list-group-item" data-parent="#vendedores">
        <i class="fa fa-angle-right"></i> Alianza
      </a>
    </li>
  </div> 

  <li>
    <a href="#admin" class="list-group-item" data-toggle="collapse" data-parent="#admin" style="background-color: #f5f5f5;color: #00a7cf">
      <i class="fa fa-table"></i> Administración
    </a>
  </li>
  <div class="collapse list-group-submenu list-group-submenu-1" id="admin">
    <li>
      <a href="{{ route('admin.products') }}" class="list-group-item" data-parent="#admin">
        <i class="fa fa-angle-right"></i> Productos
      </a>
    </li>
    <li>
      <a href="{{ route('admin.sellers.shop') }}" class="list-group-item" data-parent="#admin">
        <i class="fa fa-angle-right"></i> Tiendas
      </a>
    </li>
  </div> 

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