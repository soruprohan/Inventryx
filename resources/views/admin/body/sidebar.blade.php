<div class="app-sidebar-menu">
                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="logo-box">
                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="24">
                                </span>
                            </a>
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="24">
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
                                    <i data-feather="users"></i>
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
                                    <i data-feather="users"></i>
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
                                    <i data-feather="users"></i>
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
                                    <i data-feather="users"></i>
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
                                    <i data-feather="users"></i>
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
                                    <i data-feather="users"></i>
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
                                        @if (Auth::guard('web')->user()->can('all.return.purchase')) 
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
                                    <i data-feather="users"></i>
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
                                        @if (Auth::guard('web')->user()->can('all.sale.return')) 
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
                                    <i data-feather="alert-octagon"></i>
                                    <span> Due Setup </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Due">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('due.sale')) 
                                        <li>
                                            <a href="{{route('due.sale')}}" class="tp-link">Sales Due</a>
                                        </li>
                                        @endif
                                        @if (Auth::guard('web')->user()->can('due.sale.return')) 
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
                                    <i data-feather="alert-octagon"></i>
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

                            

                            <li class="menu-title mt-2">General</li>

                            @if (Auth::guard('web')->user()->can('role.menu')) 
                            <li>
                                <a href="#sidebarBaseui" data-bs-toggle="collapse">
                                    <i data-feather="package"></i>
                                    <span> Role & Permissions </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarBaseui">
                                    <ul class="nav-second-level">
                                        @if (Auth::guard('web')->user()->can('all.permission')) 
                                        <li>
                                            <a href="{{route('all.permission')}}" class="tp-link">All Permissions</a>
                                        </li>
                                        @endif

                                        @if (Auth::guard('web')->user()->can('all.roles')) 
                                        <li>
                                            <a href="{{route('all.roles')}}" class="tp-link">All Roles</a>
                                        </li>
                                        @endif
                                        
                                        @if (Auth::guard('web')->user()->can('add.roles.permission')) 
                                        <li>
                                            <a href="{{route('add.roles.permission')}}" class="tp-link">Role in Permission</a>
                                        </li>
                                        @endif

                                        @if (Auth::guard('web')->user()->can('all.roles.permission')) 
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
                                    <i data-feather="package"></i>
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