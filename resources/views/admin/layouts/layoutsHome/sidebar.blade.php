<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
            <div class="sidebar-logo">
                <a href="{{route('admin.dashboard')}}">Foodies</a>
            </div>
        </div>
  
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{route('admin.dashboard')}}" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Home Dashboard</span>
                </a>
            </li>
            {{-- <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-agenda"></i>
                    <span>Task</span>
                </a>
            </li> --}}

            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                    data-bs-target="#set" aria-expanded="false" aria-controls="set">
                    <i class="lni lni-pagination"></i>
                    <span>Pages</span>
                </a>
                <ul id="set" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{route('admin.homepage')}}" class="sidebar-link">Home Page</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                    data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="lni lni-protection"></i>
                    <span>CRUD</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/admin/category" class="sidebar-link">Category Manager</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/admin/brand" class="sidebar-link">Brand Manager</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="/admin/product" class="sidebar-link">Products Manager</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="/blog/view" class="sidebar-link">Blog Manager</a>
                    </li>
                   
                    <li class="sidebar-item">
                        <a href="/reviews/view" class="sidebar-link">Review Manager</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                    data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                    <i class="lni lni-layout"></i>
                    <span>Manage Orders</span>
                </a>
                
                <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                            Orders Manager
                        </a>
                        <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a href="/admin/orders" class="sidebar-link">Order Items</a>
                            </li>
                            {{-- <li class="sidebar-item">
                                <a href="/admin/delivery" class="sidebar-link">Delivered Items</a>
                            </li>
                       --}}
                        </ul>
                    </li>
                </ul>

                {{-- ------------------ --}}
                <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/admin/userOrdersManager" class="sidebar-link collapsed" 
                           >
                            Users Orders Manager
                        </a>
                        {{-- <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a href="/orders/view" class="sidebar-link">Order Items</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="/order/delivered" class="sidebar-link">Delivered Items</a>
                            </li>
                        </ul> --}}
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="/admin/notifcations" class="sidebar-link">
                    <i class="lni lni-popup"></i>
                    <span>Notification</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/setting/view" class="sidebar-link">
                    <i class="lni lni-cog"></i>
                    <span>Setting</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{route('admin.logout')}}" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>