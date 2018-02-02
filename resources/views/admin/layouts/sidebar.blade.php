            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{route('dashboard')}}">Bitnow</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="/"><i class="fa fa-home fa-fw"></i> Website</a></li>
                </ul>

                <ul class="nav navbar-right navbar-top-links">
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> Administrator <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="{{route('admin.setting')}}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                                <!-- /input-group -->
                            </li>

                            <li>
                                <a href="{{route('admin.dashboard')}}" @if($menu=='dashboard') class="active" @endif><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>

                            <li>
                                <a href="#"  @if($menu=='order') class="active" @endif><i class="fa fa-shopping-cart fa-fw"></i>Orders<span class="fa arrow"></span></a>    
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{route('admin.orders.all')}}">All Orders</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.orders.completed')}}">Completed Orders</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.orders.new')}}">New Orders</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('admin.reports')}}" @if($menu=='reports') class="active" @endif><i class="fa fa-file-text-o fa-fw"></i> Reports</a>
                            </li>
                            <li>
                                <a href="{{route('admin.users')}}" @if($menu=='users') class="active" @endif><i class="fa fa-user fa-fw"></i> Users</a>
                            </li>
                            <li>
                          
                                <a href="#"  @if($menu=='setting') class="active" @endif><i class="fa fa-gear fa-fw"></i>Setting<span class="fa arrow"></span></a>    
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{route('admin.settings.social')}}">Discount and Social Media</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.settings.payment')}}">Payment Method</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.settings.faq')}}">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.settings.text')}}">Texts</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </nav>
