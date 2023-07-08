<!--sidebar wrapper -->

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rukada</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}" >
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.brand.create')}}"><i class="bx bx-right-arrow-alt"></i>Add</a>
                </li>
                <li> <a href="{{route('admin.brand.list')}}"><i class="bx bx-right-arrow-alt"></i>Brand List</a>
                </li>

            </ul>
        </li>
        <li class="menu-label">Category Opeations</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.category.create')}}"><i class="bx bx-right-arrow-alt"></i>Add</a>
                </li>
                <li> <a href="{{route('admin.category.list')}}"><i class="bx bx-right-arrow-alt"></i>Category List</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Sub Category</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.subcategory.create')}}"><i class="bx bx-right-arrow-alt"></i>Add</a>
                </li>
                <li> <a href="{{route('admin.subcategory.list')}}"><i class="bx bx-right-arrow-alt"></i>Sub Category List</a>
                </li>

            </ul>
        </li>
        <li class="menu-label">Vendor Management</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Vendors</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.active.vendors')}}"><i class="bx bx-right-arrow-alt"></i>Active Vendors</a>
                </li>
                <li> <a href="{{route('admin.inactive.vendors')}}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendors</a>
                </li>

            </ul>
        </li>
        <li class="menu-label">Product Management</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Products</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.active.vendors')}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
                <li> <a href="{{route('admin.inactive.vendors')}}"><i class="bx bx-right-arrow-alt"></i>Products List</a
                </li>

            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
