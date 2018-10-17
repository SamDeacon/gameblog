  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('img/admin/RETRO SHRINE.png')}}" alt="Retroshrine" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><img src="{{ asset('img/admin/RETRO SHRINE HORIZONTAL.png')}}" width="145"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/admin/diver.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item">
             <a href="{{route('admin.dashboard')}}" class="nav-link">
               <i class="nav-icon fa fa-th text-cyan"></i>
               <p>
                 Dashboard
               </p>
             </a>
           </li>
          @can('isAdminOrEditor')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-gamepad text-green"></i>
              <p>
                Games
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  &nbsp;&nbsp;<i class="nav-icon fa fa-list-alt text-red"></i>
                  <p>Full List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.games.consoles') }}" class="nav-link">
                  &nbsp;&nbsp;<i class="nav-icon fa fa-gamepad text-blue"></i>
                  <p>Consoles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  &nbsp;&nbsp;<i class="nav-icon fa fa-gamepad text-blue"></i>
                  <p>Games by Console</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  &nbsp;&nbsp;<i class="nav-icon fa fa-dice text-yellow"></i>
                  <p>Genres</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  &nbsp;&nbsp;<i class="nav-icon fa fa-dice-four text-yellow"></i>
                  <p>Games by Genres</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan 

        {{-- ADMIN STUFF BELOW --}}

          @can('isAdminOrEditor')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cog text-yellow"></i>
              <p>
                Manage
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.categories') }}" class="nav-link">
                  &nbsp;&nbsp;<i class="nav-icon fa fa-tags text-green"></i>
                  <p>Categories</p>
                </a>
              </li>
              @can('isAdmin')
              <li class="nav-item">
                <a href="{{route('admin.users')}}" class="nav-link">
                  &nbsp;&nbsp;<i class="nav-icon fa fa-users text-yellow"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  &nbsp;&nbsp;<i class="nav-icon fa fa-times text-red"></i>
                  <p>User Blocklist</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.developer')}}" class="nav-link">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                Developer
              </p>
            </a>
          </li>
          @endcan 
          <li class="nav-item">
            <a href="{{route('admin.profile')}}" class="nav-link">
              <i class="nav-icon fa fa-user text-orange"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{url('/logout')}}" class="nav-link">
              <i class="nav-icon fa fa-power-off text-red"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>