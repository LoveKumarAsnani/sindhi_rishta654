            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Menu</li>

                            <li>
                                <a href="{{ route('dashboard') }}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i><span
                                        class="badge rounded-pill bg-info float-end"></span>
                                    <span key="t-dashboards">Dashboard</span>
                                </a>
                                {{-- <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="index.html" key="t-default">Default</a></li>
                                    <li><a href="dashboard-saas.html" key="t-saas">Saas</a></li>
                                    <li><a href="dashboard-crypto.html" key="t-crypto">Crypto</a></li>
                                    <li><a href="dashboard-blog.html" key="t-blog">Blog</a></li>
                                </ul> --}}
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="bx bx-briefcase-alt-2"></i>
                                    <span class="badge rounded-pill bg-info float-end"></span>
                                    <span key="t-dashboards">Users</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('admin.users.index') }}" key="t-saas">Listing</a></li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
