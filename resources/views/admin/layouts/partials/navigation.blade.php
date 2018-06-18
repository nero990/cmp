<div class="navbar navbar-fixed-top scroll-hide">
    <div class="container-fluid top-bar">
        <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img width="34" height="34" src="{{asset('admin/images/avatar-male.jpg')}}"/>{{auth()->user()->full_name}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-user"></i>My Account</a></li>
                        <li><a href="#"><i class="fa fa-gear"></i>Account Settings</a></li>
                        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        <a class="logo" href="{{route('home')}}">{{config('app.name')}}</a>
        <h5 id="title">{{config('app.name')}}</h5>
    </div>
    <div class="container-fluid main-nav clearfix">
        <div class="nav-collapse">
            <ul class="nav">
                <li>
                    <a href="{{route('home')}}" @yield('dashboard')><span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
                </li>
                <li>
                    <a href="{{route('families.index')}}" @yield('current_families')><span aria-hidden="true" class="se7en-tables"></span>Families</a>
                </li>
                <li>
                    <a href="{{route('bcc-zones.index')}}" @yield('current_sick_members')><span aria-hidden="true" class="se7en-tables"></span>Sick Members</a>
                </li>
                <li>
                    <a href="{{route('bcc-zones.index')}}" @yield('current_bcc_zones')><span aria-hidden="true" class="se7en-home"></span>Bcc Zones</a>
                </li>
                <li>
                    <a href="{{route('church-engagements.index')}}" @yield('current_church_engagements')><span aria-hidden="true" class="se7en-tables"></span>Church Engagements</a>
                </li>
                <li>
                    <a href="{{route('sacrament-questions.index')}}" @yield('current_sacrament_questions')><span aria-hidden="true" class="se7en-tables"></span>Sacrament Questions</a>
                </li>

                <li>
                    <a href="{{route('users.index')}}" @yield('current_users')><span aria-hidden="true" class="se7en-gallery"></span>Users</a>
                </li>

                <li class="dropdown"><a data-toggle="dropdown" href="#" @yield('current_reports')>
                        <span aria-hidden="true" class="se7en-pages"></span>Reports<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('reports.audits.index')}}" @yield('current_reports_audits')>Audit</a></li>
                        {{--<li><a href="#">Family</a></li>--}}
                        <li><a href="{{route('reports.members.index')}}">Members</a></li>
                        {{--<li><a href="#">Sick Members</a></li>--}}
                        {{--<li><a href="#">Bcc Zones</a></li>
                        <li><a href="#">Church Engagements</a></li>
                        <li><a href="#">Sacrament Details</a></li>
                        <li><a href="#">User</a></li>--}}
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>