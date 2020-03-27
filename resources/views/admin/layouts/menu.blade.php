            <div class="navbar-default sidebar" role="navigation">

                <div class="sidebar-nav navbar-collapse">

                    <div class="user-panel">
                        <div class="pull-left image"> <img src="backEnd/dist/image/admin_phong.jpg" class="img-circle" alt="User Image"> </div>
                        <div class="pull-left info">
                            <p>Welcome {{ Auth::user()->name }}</p>
                            <a><i class="fa fa-circle" style="color:#36d239"></i> Online</a>
                        </div>
                    </div>

                    <ul class="nav" id="side-menu">
                        <li>
                            <a href=" {{ Route('admin.dashboard.index') }} "><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a><i class="fa fa-bars fa-fw"></i> Category<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/category">List Category</a>
                                </li>
                                <li>
                                    <a href="admin/category/create">Add Category</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a ><i class="fa fa-cube fa-fw"></i> Product<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/product">List Product</a>
                                </li>
                                <li>
                                    <a href="admin/product/create">Add Product</a>
                                </li>
                                <li>
                                    <a href="{{ Route('admin.product.showRestore') }}">Restore Product</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a ><i class="fa fa-comments fa-fw"></i> Comments<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/comment">List Product Comments</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a ><i class="fa fa-book fa-fw"></i> Order<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href=" {{ Route('admin.order.index') }} ">List Order</a>
                                </li>
                            </ul>
                         </li>
                            <!-- /.nav-second-level -->
                        <li>
                            <a ><i class="fa fa-image fa-fw"></i> Slide<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href=" {{ Route('admin.slide.index') }} ">List Slide</a>
                                </li>
                                <li>
                                    <a href=" {{ Route('admin.slide.create') }} ">Add Slide</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a ><i class="fa fa-bank fa-fw"></i> Stock <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href=" {{ Route('admin.stock.index') }} ">List Stock</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li style="display: {{ (Auth::user()->role == 2)?'block':'none' }};">
                            <a><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href=" {{ Route('admin.user.index') }} ">List User</a>
                                </li>
                                <li>
                                    <a href=" {{ Route('admin.user.create') }} ">Add User</a>
                                </li>
                                <li>
                                    <a href="{{ Route('admin.user.showRestore') }}">Restore User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                        
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->