<div class="app-sidebar-menu">
                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="logo-box">
                            <a href="{{ route('dashboard') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('backend/assets/images/inventryx_logo.png') }}" alt="" height="36">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('backend/assets/images/inventryx_logo.png') }}" alt="" height="48">
                                </span>
                            </a>
                            <a href="{{ route('dashboard') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('backend/assets/images/inventryx_logo.png') }}" alt="" height="36">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('backend/assets/images/inventryx_logo.png') }}" alt="" height="48">
                                </span>
                            </a>
                        </div>

                        <ul id="side-menu">

                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="{{ route('dashboard') }}" class="tp-link">
                                    <i data-feather="home"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>


                            <li class="menu-title">Pages</li>
                            @if (Auth::guard('web')->user()->can('brand.menu')) 
                            <li>
                                    <a href="#Brand" data-bs-toggle="collapse">
                                        <i data-feather="tag"></i>
                                        <span> Brand Manage </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Brand">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.brand')) 
                                        <li>
                                            <a href="{{route('all.brand')}}" class="tp-link">All Brands</a>
                                        </li>
                                        @endif
                                        
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::guard('web')->user()->can('warehouse.menu')) 
                            <li>
                                    <a href="#WareHouse" data-bs-toggle="collapse">
                                        <i data-feather="archive"></i>
                                        <span> WareHouse Manage </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="WareHouse">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.warehouse')) 
                                        <li>
                                            <a href="{{route('all.warehouse')}}" class="tp-link">All Warehouses</a>
                                        </li>
                                      
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::guard('web')->user()->can('supplier.menu')) 
                            <li>
                                    <a href="#Supplier" data-bs-toggle="collapse">
                                        <i data-feather="truck"></i>
                                        <span> Supplier Manage </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Supplier">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.supplier')) 
                                        <li>
                                            <a href="{{route('all.supplier')}}" class="tp-link">All Suppliers</a>
                                        </li>
                                        @endif
                                      
                                        
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::guard('web')->user()->can('customer.menu')) 
                            <li>
                                    <a href="#Customer" data-bs-toggle="collapse">
                                        <i data-feather="user"></i>
                                        <span> Customer Manage </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Customer">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.customer')) 
                                        <li>
                                            <a href="{{route('all.customer')}}" class="tp-link">All Customers</a>
                                        </li>
                                        @endif
                                      
                                        
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::guard('web')->user()->can('product.menu')) 
                            <li>
                                    <a href="#Product" data-bs-toggle="collapse">
                                        <i data-feather="box"></i>
                                        <span> Product Manage </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Product">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.category')) 
                                        <li>
                                            <a href="{{route('all.category')}}" class="tp-link">All Categories</a>
                                        </li>
                                        @endif
                                        @if (Auth::guard('web')->user()->can('all.product')) 
                                        <li>
                                            <a href="{{route('all.product')}}" class="tp-link">All Products</a>
                                        </li>
                                        @endif
                                      
                                        
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::guard('web')->user()->can('purchase.menu')) 
                            <li>
                                    <a href="#Purchase" data-bs-toggle="collapse">
                                        <i data-feather="shopping-cart"></i>
                                        <span> Purchase Manage </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Purchase">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.purchase')) 
                                        <li>
                                            <a href="{{route('all.purchase')}}" class="tp-link">All Purchase</a>
                                        </li>
                                        @endif
                                        @if (Auth::guard('web')->user()->can('return.purchase')) 
                                        <li>
                                            <a href="{{route('all.return.purchase')}}" class="tp-link">Purchase Return</a>
                                        </li>
                                        @endif
                                      
                                        
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::guard('web')->user()->can('sale.menu')) 
                            <li>
                                    <a href="#Sale" data-bs-toggle="collapse">
                                        <i data-feather="dollar-sign"></i>
                                        <span> Sale Manage </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Sale">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.sale')) 
                                        <li>
                                            <a href="{{route('all.sale')}}" class="tp-link">All Sales</a>
                                        </li>
                                        @endif
                                        @if (Auth::guard('web')->user()->can('return.sale')) 
                                        <li>
                                            <a href="{{route('all.sale.return')}}" class="tp-link">Sale Return</a>
                                        </li>
                                        @endif
                                      
                                        
                                    </ul>
                                </div>
                            </li>
                            @endif


                            @if (Auth::guard('web')->user()->can('due.menu')) 
                            <li>
                                    <a href="#Due" data-bs-toggle="collapse">
                                        <i data-feather="credit-card"></i>
                                        <span> Due Setup </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Due">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('due.sales')) 
                                        <li>
                                            <a href="{{route('due.sale')}}" class="tp-link">Sales Due</a>
                                        </li>
                                        @endif
                                        @if (Auth::guard('web')->user()->can('due.sales.return')) 
                                        <li>
                                            <a href="{{route('due.sale.return')}}" class="tp-link">Sales Return Due</a>
                                        </li>
                                        @endif
                                        
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::guard('web')->user()->can('transfer.menu')) 
                            <li>
                                    <a href="#Transfers" data-bs-toggle="collapse">
                                        <i data-feather="repeat"></i>
                                        <span> Transfers Setup </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Transfers">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.transfer')) 
                                        <li>
                                            <a href="{{route('all.transfer')}}" class="tp-link">Transfers</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif


                            @if (Auth::guard('web')->user()->can('rolepermission.menu'))
                            <li>
                                    <a href="#RolePermission" data-bs-toggle="collapse">
                                        <i data-feather="shield"></i>
                                        <span> Role & Permissions </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="RolePermission">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.permission'))
                                        <li>
                                            <a href="{{route('all.permission')}}" class="tp-link">All Permissions</a>
                                        </li>
                                        @endif

                                        @if (Auth::guard('web')->user()->can('all.role'))
                                        <li>
                                            <a href="{{route('all.roles')}}" class="tp-link">All Roles</a>
                                        </li>
                                        @endif

                                        @if (Auth::guard('web')->user()->can('all.rolepermission')) 
                                        <li>
                                            <a href="{{route('all.roles.permission')}}" class="tp-link">All Role Permission</a>
                                        </li>
                                        @endif
                                        
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::guard('web')->user()->can('admin.menu')) 
                            <li>
                                    <a href="#sidebarManageAdmin" data-bs-toggle="collapse">
                                        <i data-feather="user-check"></i>
                                        <span> Manage Admin </span>
                                        <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarManageAdmin">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.admin')) 
                                        <li>
                                            <a href="{{route('all.admin')}}" class="tp-link">All Admin</a>
                                        </li>
                                        @endif
                                        
                                    </ul>
                                </div>
                            </li>
                            @endif

                          
                        </ul>
            
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
            </div>