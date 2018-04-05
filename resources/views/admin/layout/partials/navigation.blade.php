<div class="navbar navbar-fixed-top scroll-hide">
    <div class="container-fluid top-bar">
        <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown notifications hidden-xs">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true"
                                                                                     class="se7en-flag"></span>
                        <div class="sr-only">Notifications</div>
                        <p class="counter">4</p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">
                                <div class="notifications label label-info">New</div>
                                <p>New user added: Jane Smith</p></a>
                        </li>
                        <li><a href="#">
                                <div class="notifications label label-info">New</div>
                                <p>Sales targets available</p></a>
                        </li>
                        <li><a href="#">
                                <div class="notifications label label-info">New</div>
                                <p>New performance metric added</p></a>
                        </li>
                        <li><a href="#">
                                <div class="notifications label label-info">New</div>
                                <p>New growth data available</p></a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown messages hidden-xs">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-envelope"></span>
                        <div class="sr-only">Messages</div>
                        <p class="counter">3</p>
                    </a>
                    <ul class="dropdown-menu messages">
                        <li><a href="#">
                                <img width="34" height="34" src="{{asset('admin/images/avatar-male2.png')}}"/>Could we meet today? I wanted...</a>
                        </li>
                        <li><a href="#">
                                <img width="34" height="34" src="{{asset('admin/images/avatar-female.png')}}"/>Important data needs your analysis...</a>
                        </li>
                        <li><a href="#">
                                <img width="34" height="34" src="{{asset('admin/images/avatar-male2.png')}}"/>Buy Se7en today, it's a great theme...</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img width="34" height="34" src="{{asset('admin/images/avatar-male.jpg')}}"/>John Smith<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-user"></i>My Account</a></li>
                        <li><a href="#"><i class="fa fa-gear"></i>Account Settings</a></li>
                        <li><a href="login1.html"><i class="fa fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        <a class="logo" href="index.html">se7en</a>
        <form class="navbar-form form-inline col-lg-2 hidden-xs">
            <input class="form-control" placeholder="Search" type="text">
        </form>
    </div>
    <div class="container-fluid main-nav clearfix">
        <div class="nav-collapse">
            <ul class="nav">
                <li>
                    <a href="index.html"><span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
                </li>
                <li class="dropdown"><a data-toggle="dropdown" href="#">
                        <span aria-hidden="true" class="se7en-tables"></span>Families<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="tables.html">All</a></li>
                        <li><a href="datatables.html">New</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a data-toggle="dropdown" href="#">
                        <span aria-hidden="true" class="se7en-tables"></span>Sick Members<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">All</a></li>
                        <li><a href="#">New</a></li>
                    </ul>
                </li>
                <li class="dropdown current"><a data-toggle="dropdown" @yield('current_bcc_zones') href="#">
                        <span aria-hidden="true" class="se7en-tables"></span>Bcc Zones<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('bcc-zones.index')}}" @yield('current_bcc_zones_index')>All</a></li>
                        <li><a href="{{route('bcc-zones.create')}}" @yield('current_bcc_zones_create')>New</a></li>
                    </ul>
                </li>

                <li class="dropdown"><a data-toggle="dropdown" @yield('current_church_engagements') href="#">
                        <span aria-hidden="true" class="se7en-tables"></span>Church Engagements<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('church-engagements.index')}}" @yield('current_church_engagements_index')>All</a></li>
                        <li><a href="{{route('church-engagements.create')}}" @yield('current_church_engagements_create')>New</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a data-toggle="dropdown" @yield('current_sacrament_details') href="#">
                        <span aria-hidden="true" class="se7en-tables"></span>Sacrament Details<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('sacrament-details.index')}}" @yield('current_sacrament_details_index')>All</a></li>
                        <li><a href="{{route('sacrament-details.create')}}" @yield('current_sacrament_details_index')>New</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a data-toggle="dropdown" @yield('current_users') href="#">
                        <span aria-hidden="true" class="se7en-tables"></span>User<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" @yield('current_users_index')>All</a></li>
                        <li><a href="#" @yield('current_users_index')>New</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a data-toggle="dropdown" href="#">
                        <span aria-hidden="true" class="se7en-pages"></span>Reports<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Audit</a></li>
                        <li><a href="#">Family</a></li>
                        <li><a href="#">Members</a></li>
                        <li><a href="#">Sick Members</a></li>
                        <li><a href="#">Bcc Zones</a></li>
                        <li><a href="#">Church Engagements</a></li>
                        <li><a href="#">Sacrament Details</a></li>
                        <li><a href="#">User</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>