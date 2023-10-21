<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                         aria-expanded="false"><img src="{{ asset('assets/images/profile_default.jpg') }}" alt="user-img"
                                                                    class="img-circle"><span class="hide-menu">{{ auth()->user()->name }}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('user.logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
