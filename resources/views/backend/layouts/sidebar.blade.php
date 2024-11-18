<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('logo') }}/logo.png" class="logo-icon" alt="logo icon" width="50px">
        </div>
        <div>
            <h4 class="logo-text">Hypershop</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="menu-label">Product Stage</li>
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="bx bx-duplicate"></i>
                </div>
                <div class="menu-title">Manage Supplier</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('supplier.all') }}"><i class="bx bx-right-arrow-alt"></i>All Supplier</a>
                </li>
                <li>
                    <a href="{{ route('supplier.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Supplier</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="lni lni-grid"></i>
                </div>
                <div class="menu-title">Manage Shelf</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('shelves.all') }}"><i class="bx bx-right-arrow-alt"></i>All Shelves</a>
                </li>
                <li>
                    <a href="{{ route('shelves.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Shelf</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fadeIn animated bx bx-unite"></i>
                </div>
                <div class="menu-title">Manage Unit</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('unit.all') }}"><i class="bx bx-right-arrow-alt"></i>All Unit</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fadeIn animated bx bx-store"></i>
                </div>
                <div class="menu-title">Manage Category</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('category.all') }}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Manage Product</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('product.all') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>
                <li>
                    <a href="{{ route('product.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="bx bx-user-plus"></i>
                </div>
                <div class="menu-title">Manage Customer</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('customer.all') }}"><i class="bx bx-right-arrow-alt"></i>All Customer</a>
                </li>
                <li>
                    <a href="{{ route('customer.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Customer</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Purchase Stage</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="lni lni-cart-full"></i>
                </div>
                <div class="menu-title">Manage Purchase</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('purchase.all') }}"><i class="bx bx-right-arrow-alt"></i>All Purchase</a>
                </li>
                <li>
                    <a href="{{ route('purchase.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Purchase</a>
                </li>
                <li>
                    <a href="{{ route('purchase.pending') }}"><i class="bx bx-right-arrow-alt"></i>Approval Purchase</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Sales Stage</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="lni lni-shopping-basket"></i>
                </div>
                <div class="menu-title">Manage Sales</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('invoice.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Invoice</a>
                </li>
                <li>
                    <a href="{{ route('invoice.all') }}"><i class="bx bx-right-arrow-alt"></i>All Invoice</a>
                </li>
                <li>
                    <a href="{{ route('invoice.pending') }}"><i class="bx bx-right-arrow-alt"></i>Processing Invoice</a>
                </li>
                <li>
                    <a href="{{ route('invoice.on.delivery') }}"><i class="bx bx-right-arrow-alt"></i>On Delivery Invoice</a>
                </li>
                <li>
                    <a href="{{ route('invoice.delivered') }}"><i class="bx bx-right-arrow-alt"></i>Delivered Invoice</a>
                </li>
                <li>
                    <a href="{{ route('invoice.returned') }}"><i class="bx bx-right-arrow-alt"></i>Returned Invoice</a>
                </li>
            </ul>
        </li>
       
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fadeIn animated bx bx-file"></i>
                </div>
                <div class="menu-title">API Integration</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('courier.api') }}"><i class="bx bx-right-arrow-alt"></i>Courier API</a>
                </li>
            </ul>
        </li>
       
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fadeIn animated bx bx-file"></i>
                </div>
                <div class="menu-title">All Reports</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('stock.report') }}"><i class="bx bx-right-arrow-alt"></i>Stock Report</a>
                </li>
                <li>
                    <a href="{{ route('stock.supplier.wise') }}"><i class="bx bx-right-arrow-alt"></i>Supplier/Product Wise Report</a>
                </li>
                <li>
                    <a href="{{ route('daily.purchase.report') }}"><i class="bx bx-right-arrow-alt"></i>Daily Purchase Report</a>
                </li>
                <li>
                    <a href="{{ route('daily.invoice.report') }}"><i class="bx bx-right-arrow-alt"></i>Daily Sales Report</a>
                </li>
            </ul>
        </li>
        
        <li>
            <a href="{{ route('logout') }}">
                <div class="parent-icon"><i class="lni lni-exit"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
