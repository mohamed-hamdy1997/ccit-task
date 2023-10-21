<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                         aria-expanded="false"><img src="{{ asset('assets/images/profile_default.jpg') }}" alt="user-img"
                                                                    class="img-circle"><span class="hide-menu">Admin</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('admin.logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </li>
                <li class="nav-small-cap">--- Users</li>
                <li> <a class="waves-effect waves-dark {{isActiveRoute('admin.getAllUsers')}}" href="{{ route('admin.getAllUsers') }}"><i class="ti-face-smile"></i><span
                            class="hide-menu">Users</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
