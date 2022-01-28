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
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Layout Options
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sidebar</p>
                </a>
              </li>
           
            </ul>
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