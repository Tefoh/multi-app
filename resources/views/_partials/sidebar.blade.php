<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="{{ config('app.name') }} Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پنل {{ auth()->user()->fa_type }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('images/profile.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    <p style="color: #c2c7d0;" >{{ auth()->user()->fa_type }}</p>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                داشبورد
                            </p>
                        </router-link>
                    </li>
                    @can('isAdmin')
                        <li class="nav-item has-treeview">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="nav-icon fa fa-table"></i>
                                <p>
                                    مدیریت
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/users" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>کاربران</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                    @endcan


                    <li class="nav-item has-treeview">
                        <a href="/projects" class="nav-link">
                            <i class="nav-icon fa fa-th-list"></i>
                            <p>
                                پروژه
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link to="/projects" class="nav-link">
                                    <i class="nav-icon fa fa-files-o"></i>
                                    <p>
                                        پروژه ها
                                    </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/project/create" class="nav-link">
                                    <i class="nav-icon fa fa-file-text-o"></i>
                                    <p>
                                        ساخت پروژه
                                    </p>
                                </router-link>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <router-link to="/profile" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                پروفایل
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                           class="nav-link"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-power-off"></i>
                            <p>
                                خروج
                            </p>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>