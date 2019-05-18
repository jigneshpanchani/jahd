<aside id="sidebar_main">
    <div class="sidebar_main_header" style="font-size: 17px!important; padding-top: 24px;">
        <div class="sidebar_logo">
            <a href="{{ route('dashboard') }}" class="sSidebar_hide sidebar_logo_large">
                <strong>&nbsp;જય આપાહરદાસ ડાયમંડ</strong>
                {{--<img class="logo_regular" src="{{ asset('assets/img/logo_main.png') }}" alt="" height="15" width="71"/>--}}
                {{--<img class="logo_light" src="{{ asset('assets/img/logo_main_white.png') }}" alt="" height="15" width="71"/>--}}
            </a>
            <a href="{{ route('dashboard') }}" class="sSidebar_show sidebar_logo_small">
                <img class="logo_regular" src="{{ asset('assets/img/logo_main_small.png') }}" alt="" height="32" width="32"/>
                <img class="logo_light" src="{{ asset('assets/img/logo_main_small_light.png') }}" alt="" height="32" width="32"/>
            </a>
        </div>
    </div>

    <div class="menu_section">
        <ul>
            <?php
            $currentRoute = Request::route()->getName();
            //$ckRoute = Request::is('employee.index');
            //$ckRoute = (Request::is('employee/*')) ? 'current_section' : '';
            ?>

            <li title="Dashboard" class="{{ ($currentRoute == 'dashboard') ? 'current_section' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">Dashboard</span>
                </a>
            </li>
            <li title="Employee" class="{{ (Request::is('employee') || Request::is('employee/*')) ? 'current_section' : '' }}">
                <a href="{{ route('employee.index') }}">
                    <span class="menu_icon"><i class="material-icons">&#xE87C;</i></span>
                    <span class="menu_title">Employee</span>
                </a>
                <ul>
                    <li class="{{ (Request::is('employee')) ? 'act_item' : '' }}">
                        <a href="{{ route('employee.index') }}">List</a>
                    </li>
                    <li class="{{ (Request::is('employee/*')) ? 'act_item' : '' }}">
                        <a href="{{ route('employee.create') }}">Add</a>
                    </li>
                </ul>
            </li>
            <li title="Department" class="{{ (Request::is('department') || Request::is('department/*')) ? 'current_section' : '' }}">
                <a href="{{ route('department.index') }}">
                    <span class="menu_icon"><i class="material-icons">&#xE8C0;</i></span>
                    <span class="menu_title">Department</span>
                </a>
                <ul>
                    <li class="{{ (Request::is('department')) ? 'act_item' : '' }}">
                        <a href="{{ route('department.index') }}">List</a>
                    </li>
                    <li class="{{ (Request::is('department/*')) ? 'act_item' : '' }}">
                        <a href="{{ route('department.create') }}">Add</a>
                    </li>
                </ul>
            </li>
            <li title="Department" class="{{ (Request::is('work') || Request::is('work/*')) ? 'current_section' : '' }}">
                <a href="{{ route('work.index') }}">
                    <span class="menu_icon"><i class="material-icons">&#xE87B;</i></span>
                    <span class="menu_title">Work</span>
                </a>
                <ul>
                    <li class="{{ (Request::is('work')) ? 'act_item' : '' }}">
                        <a href="{{ route('work.index') }}">List</a>
                    </li>
                    <li class="{{ (Request::is('work/*')) ? 'act_item' : '' }}">
                        <a href="{{ route('work.create') }}">Add</a>
                    </li>
                </ul>
            </li>
            <li title="Report" class="{{ ($currentRoute == 'report') ? 'current_section' : '' }}">
                <a href="{{ route('report') }}">
                    <span class="menu_icon"><i class="material-icons">&#xE241;</i></span>
                    <span class="menu_title">Report</span>
                </a>
            </li>
            <li title="Sticky Notes">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="menu_icon"><i class="material-icons">&#xE7F4;</i></span>
                    <span class="menu_title">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>