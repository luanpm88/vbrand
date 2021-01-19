 <!-- Top Bar Start -->

            <div class="topbar">



                <!-- LOGO -->

                <div class="topbar-left">

                    <a href="index.html" class="logo">

                        <span>

                                <img src="assets/images/logo-light.png" alt="" height="18">

                            </span>

                        <i>

                                <img src="assets/images/logo-sm.png" alt="" height="22">

                            </i>

                    </a>

                </div>



                <nav class="navbar-custom">

                    <ul class="navbar-right list-inline float-right mb-0">

                        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">

                            <form role="search" class="app-search">

                                <div class="form-group mb-0">

                                    <input type="text" name="keysearch" class="form-control" placeholder="Search..">

                                    <button type="submit"><i class="fa fa-search"></i></button>

                                </div>

                            </form>

                        </li>



                         



                        <!-- full screen -->

                        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">

                            <a class="nav-link waves-effect" href="#" id="btn-fullscreen">

                                <i class="mdi mdi-fullscreen noti-icon"></i>

                            </a>

                        </li>



                        <!-- notification -->

                        <li class="dropdown notification-list list-inline-item">

                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                                <i class="mdi mdi-bell-outline noti-icon"></i>  
                            </a> 

                        </li>

                        <li class="dropdown notification-list list-inline-item">

                            <div class="dropdown notification-list nav-pro-img">

                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                                    <img src="assets/images/users/user-4.jpg" alt="user" class="rounded-circle">

                                </a>

                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                                    <!-- item-->

                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>

                                    <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> My Wallet</a>

                                    <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings m-r-5"></i> Settings</a>

                                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5"></i> Lock screen</a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item text-danger" href="{{ url('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="mdi mdi-power text-danger"></i>
                                        Logout
                                    </a>
                                     
                                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">@csrf</form>

                                </div>

                            </div>

                        </li>



                    </ul>



                    <ul class="list-inline menu-left mb-0">

                        <li class="float-left">

                            <button class="button-menu-mobile open-left waves-effect">

                                <i class="mdi mdi-menu"></i>

                            </button>

                        </li>

                        <li class="d-none d-sm-block">
                            <div class="dropdown pt-3 d-inline-block">
                                <a class="btn btn-light " href="#" >
                                        Admin
                                    </a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Top Bar End -->