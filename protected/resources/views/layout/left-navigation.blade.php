    <style>
        .logo_pic {
            width: 35%;
            float: left;
        }
        .img-circle.logo_img {
            width: 50%;
            background: #fff;
            z-index: 1000;
            position: inherit;
            border: 1px solid rgba(52,73,94,.44);
            padding: 4px;
        }
    </style>
     <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('dashboard')}}" class="site_title">
                  <div class="logo_pic clearfix">
                    <img src="{{asset("protected/storage/uploads/images/logo.png")}}" alt="..." class="img-circle logo_img">
                  </div>
                  <span>TBA HR</span>
                </a>
            </div>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset("protected/storage/uploads/images/img.jpg")}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                @if(Auth::check())
                <span>Welcome,</span>
                <h2>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h2>
                @endif
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br/>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{url('home')}}"><i class="fa fa-home"></i>Dashboard</a></li>
                  <li><a><i class="fa fa-group"></i> Employees <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('employees')}}">All Employees</a></li>
                      <li><a href="{{url('employees/create')}}">Add Employee</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Settings</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-product-hunt" aria-hidden="true"></i> Professions <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('professions/create')}}">Add profession</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-trademark" aria-hidden="true"></i>Profession Registration <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('profession-registrations/create')}}">Add Registration Profession</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-lock" aria-hidden="true"></i> Admins <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{url('admins/create')}}">Add Admin</a>
                    </ul>
                  </li>
                  <li>
                     <a href="javascript:void(0)"><i class="fa fa-sliders" aria-hidden="true"></i> Roles <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{url('roles/create')}}">Add role</a>
                    </ul>
                    </li>
                    <li>
                     <a href="javascript:void(0)"><i class="fa fa-map-marker" aria-hidden="true"></i> Region <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{url('regions/create')}}">Add region</a>
                    </ul>
                    </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Reports</h3>
                <ul class="nav side-menu">
                  <li>
                      <a href="{{url('employee-report')}}"><i class="fa fa-users"></i> Employees </a>
                  </li>
                  <li><a><i class="fa fa-product-hunt"></i> Professionals <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('professions')}}"> All Professionals</a></li>
                      <li> <a href="{{url('profession-registrations')}}"> All Profession Registrations</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-lock"></i> Admins <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li> <a href="{{url('admins')}}">All Admins</a></li>
                     </ul>
                  </li>
                  </li>
                  <li><a><i class="fa fa-sliders"></i> Roles <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('roles')}}">All Roles</a></li>
                     </ul>
                  </li>
                  </li>
                  <li><a><i class="fa fa-map-marker"></i> Region <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('regions')}}">All region</a></li>
                     </ul>
                  </li>
                  </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form-1').submit();"
              >
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
              <form id="logout-form-1" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
