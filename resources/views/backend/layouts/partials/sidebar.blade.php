@php $admin = Auth::guard()->user(); @endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
      <img src="dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{$admin->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @if ($admin->can('role.create') || $admin->can('role.view') ||  $admin->can('role.edit') ||  $admin->can('role.delete'))
          <li class="nav-item">
            <a href="{{route('admin.roles.index')}}" class="nav-link {{ Route::is('admin.roles.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>Roles</p>
            </a>
          </li>
          @endif
          @if ($admin->can('user.create') || $admin->can('user.view') ||  $admin->can('user.edit') ||  $admin->can('user.delete'))
          <li class="nav-item">
            <a href="{{route('admin.users.index')}}" class="nav-link {{ Route::is('admin.users.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>Users</p>
            </a>
          </li>
          @endif
          

          <li class="nav-item has-treeview">
            <a class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Elements
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if ($admin->can('division.create') || $admin->can('division.view') ||  $admin->can('division.edit') ||  $admin->can('division.delete'))
              <li class="nav-item">
                <a href="{{route('admin.divisions.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Division</p>
                </a>
              </li>
              @endif
              @if ($admin->can('brand.create') || $admin->can('brand.view') ||  $admin->can('brand.edit') ||  $admin->can('brand.delete'))
              <li class="nav-item">
                <a href="{{route('admin.brands.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
              @endif

              @if ($admin->can('colour.create') || $admin->can('colour.view') ||  $admin->can('colour.edit') ||  $admin->can('colour.delete'))
              <li class="nav-item">
                <a href="{{route('admin.colours.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Colour</p>
                </a>
              </li>
              @endif

              @if ($admin->can('vehicletype.create') || $admin->can('vehicletype.view') ||  $admin->can('vehicletype.edit') ||  $admin->can('vehicletype.delete'))
              <li class="nav-item">
                <a href="{{route('admin.vehicletypes.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vehicle type</p>
                </a>
              </li>
              @endif

              @if ($admin->can('servicetype.create') || $admin->can('servicetype.view') ||  $admin->can('servicetype.edit') ||  $admin->can('servicetype.delete'))
              <li class="nav-item">
                <a href="{{route('admin.servicetypes.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service type</p>
                </a>
              </li>
              @endif

              @if ($admin->can('unit.create') || $admin->can('unit.view') ||  $admin->can('unit.edit') ||  $admin->can('unit.delete'))
              <li class="nav-item">
                <a href="{{route('admin.units.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unit</p>
                </a>
              </li>
              @endif

              @if ($admin->can('sparepart.create') || $admin->can('sparepart.view') ||  $admin->can('sparepart.edit') ||  $admin->can('sparepart.delete'))
              <li class="nav-item">
                <a href="{{route('admin.spareparts.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Spare parts</p>
                </a>
              </li>
              @endif

              @if ($admin->can('vehicle.create') || $admin->can('vehicle.view') ||  $admin->can('vehicle.edit') ||  $admin->can('vehicle.delete'))
              <li class="nav-item">
                <a href="{{route('admin.vehicles.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vehicle</p>
                </a>
              </li>
              @endif
            </ul>
          </li>

          @if ($admin->can('assign.create') || $admin->can('assign.view') ||  $admin->can('assign.edit') ||  $admin->can('assign.delete'))
              <li class="nav-item">
                <a href="{{route('admin.assigns.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vehicle Assign</p>
                </a>
              </li>
              @endif
          
              <li class="nav-item">
                <a href="{{route('admin.estimates.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Estimate</p>
                </a>
              </li>

          <li class="nav-item">
            <a  href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Logout</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>