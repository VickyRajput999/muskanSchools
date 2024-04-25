  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('admin-assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">School</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @php
                   $user = Auth::user();
                   $userRole = $user->role;
               @endphp
            @switch($userRole)
                @case(1)
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                  <li class="nav-item">
                    <a href="{{ route('admin.list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                      <i class="far fa-user nav-icon"></i>
                      <p>Admin</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.class') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
                      <i class="far fa-user nav-icon"></i>
                      <p>Class</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.subject') }}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                      <i class="far fa-user nav-icon"></i>
                      <p>Subject</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.asignSubject') }}" class="nav-link @if(Request::segment(2) == 'asignsubject') active @endif">
                      <i class="far fa-user nav-icon"></i>
                      <p>Asign Subject</p>
                    </a>
                  </li>
                </li>
                    @break
                @case(2)
                <li class="nav-item menu-open">
                    <a href="{{ route('teacher.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                </li>
                @break
                @case(3)
                <li class="nav-item menu-open">
                    <a href="{{ route('student.dashboard') }}" class="nav-link @if(Request::segment(2) == dashboard) active @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                </li>
                @break
                @case(4)
                <li class="nav-item menu-open">
                    <a href="{{ route('parents.dashboard') }}" class="nav-link @if(Request::segment(2) == dashboard) active @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                </li>
                @break
                @default
            @endswitch
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="far fa-user nav-icon"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
