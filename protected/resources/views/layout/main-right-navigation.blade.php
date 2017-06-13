            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{url('home')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Professionals<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Computer Engineers</a>
                                </li>
                                <li>
                                    <a href="#">Civil Engineers</a>
                                </li>
                                <li>
                                    <a href="#">Electrical Engineers</a>
                                </li>
                                 <li>
                                    <a href="#">Environment Engineers</a>
                                </li>
                                <li>
                                    <a href="#">Mechanica Engineers</a>
                                </li>
                                <li>
                                    <a href="#">Quantity Surveyors</a>
                                </li>
                                <li>
                                    <a href="#">Archtects</a>
                                </li>
                                <li>
                                    <a href="#">Technicians</a>
                                </li>
                                <li>
                                    <a href="#">Accauntants</a>
                                </li>
                                <li>
                                    <a href="#">Ecomomist</a>
                                </li>
                                <li>
                                    <a href="#">Human Resource</a>
                                </li>
                                <li>
                                    <a href="#">Administrator</a>
                                </li>
                                <li>
                                    <a href="#">Valuers</a>
                                </li>
                                <li>
                                    <a href="#">Land Surveyors</a>
                                </li>
                                <li>
                                    <a href="#">Maintenance officer</a>
                                </li>
                                <li>
                                    <a href="#">Estate officers</a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Admins<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('admins')}}">All Admins</a>
                                </li>
                                <li>
                                    <a href="{{url('admins/create')}}">Add Admin</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i>  Employees<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('employees')}}">All Employees</a>
                                </li>
                                <li>
                                    <a href="{{url('employees/create')}}">Add New</a>
                                </li>                                                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-lock" aria-hidden="true"></i>  Roles<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('roles')}}">All Roles</a>
                                </li>
                                <li>
                                    <a href="{{url('roles/create')}}">Add New</a>
                                </li>                                                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-map-marker fa-fw"></i>  Regions<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('regions')}}">All Region</a>
                                </li>
                                <li>
                                    <a href="{{url('regions/create')}}">Add Region</a>
                                </li>                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>  Particulars<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('particulars')}}">All Particular</a>
                                </li>
                                <li>
                                    <a href="{{url('particulars/create')}}">Add Particular</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                         
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>