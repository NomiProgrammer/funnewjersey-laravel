<style>
    /* Stronger indentation for sidebar dropdowns */
    .nav-sidebar .nav-treeview>.nav-item>.nav-link {
        padding-left: 2rem !important;
        /* Increase as needed */
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img style="      opacity: 100;
          background: #454545;
          width: 38px;"
            src="{{ asset('dashboard/images/logo_funnj_64.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Fun New Jersey</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dashboard/images/user_image.png') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="https://www.funnewjersey.com/en/admin/index" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Parallax Slider<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/slider/all"
                                class="nav-link"><i class="fas fa-images nav-icon"></i>
                                <p>All</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/slider/manage"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>Add new</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-ad"></i>
                        <p>Banner Ads<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/banner/all"
                                class="nav-link"><i class="fas fa-flag nav-icon"></i>
                                <p>All</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/banner/manage"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>Add new</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>Invoices &amp; Billing<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/invoice/payments"
                                class="nav-link"><i class="fas fa-money-check-alt nav-icon"></i>
                                <p>Payment History</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/invoice/all/"
                                class="nav-link"><i class="fas fa-file-invoice nav-icon"></i>
                                <p>All</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/invoice/manage"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>Add new</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-header">LISTINGS</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle"></i>
                        <p>Add/Manage Listings<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/allposts"
                                class="nav-link"><i class="fas fa-list nav-icon"></i>
                                <p>All Current Listings</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/list-business" class="nav-link"><i
                                    class="fas fa-plus nav-icon"></i>
                                <p>Add New Listing</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/expiredpost"
                                class="nav-link"><i class="fas fa-clock nav-icon"></i>
                                <p>Expired Posts</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/trashedpost"
                                class="nav-link"><i class="fas fa-trash nav-icon"></i>
                                <p>Trashed Posts</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/reportedpost"
                                class="nav-link"><i class="fas fa-flag nav-icon"></i>
                                <p>Reported posts</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/claimedposts"
                                class="nav-link"><i class="fas fa-check-circle nav-icon"></i>
                                <p>Claimed business</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/emailtracker"
                                class="nav-link"><i class="fas fa-envelope-open-text nav-icon"></i>
                                <p>Email Tracker</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/bulkemailform"
                                class="nav-link"><i class="fas fa-mail-bulk nav-icon"></i>
                                <p>Bulk Email</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/locations"
                                class="nav-link"><i class="fas fa-map-marker-alt nav-icon"></i>
                                <p>Locations</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/businesssettings"
                                class="nav-link"><i class="fas fa-cogs nav-icon"></i>
                                <p>Site Settings</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/paypalsettings"
                                class="nav-link"><i class="fab fa-paypal nav-icon"></i>
                                <p>Paypal Settings</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/business/bannersettings"
                                class="nav-link"><i class="fas fa-image nav-icon"></i>
                                <p>Banner Settings</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-header">CONTENT</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Custom Combo Meta Tags<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/metas"
                                class="nav-link"><i class="fas fa-tags nav-icon"></i>
                                <p>Custom Meta Tags</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/metas/add"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>Add New Metas</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>Custom Mega Menus<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/menus"
                                class="nav-link"><i class="fas fa-th-large nav-icon"></i>
                                <p>Custom Mega Menus</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/menus/add"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>Add New Menu</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>Category<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/category/all"
                                class="nav-link"><i class="fas fa-list nav-icon"></i>
                                <p>All categories</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/category/newcategory"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>New category</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Tags<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/tag/all"
                                class="nav-link"><i class="fas fa-tags nav-icon"></i>
                                <p>All Tags</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/tag/newtag"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>New Tag</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>Fun Deals<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/deal/all"
                                class="nav-link"><i class="fas fa-gift nav-icon"></i>
                                <p>All Fun Deals</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/deal/manage"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>Add New Fun Deal</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-header">ADMIN</li>
                <li class="nav-item">
                    <a href="https://www.funnewjersey.com/en/admin/editprofile" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Packages<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/package/all"
                                class="nav-link"><i class="fas fa-boxes nav-icon"></i>
                                <p>All packages</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/package/newpackage"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>Create New Package</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/package/settings"
                                class="nav-link"><i class="fas fa-cogs nav-icon"></i>
                                <p>Package Settings</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="https://www.funnewjersey.com/en/admin/users" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Widgets<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/widgets/all"
                                class="nav-link"><i class="fas fa-th nav-icon"></i>
                                <p>All Widgets</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/widgets/widgetpositions"
                                class="nav-link"><i class="fas fa-arrows-alt nav-icon"></i>
                                <p>Widget Positions</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="https://www.funnewjersey.com/en/admin/plugins/index" class="nav-link">
                        <i class="nav-icon fas fa-cloud-upload-alt"></i>
                        <p>Upload</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Blog/News/Article<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/blog/all"
                                class="nav-link"><i class="fas fa-list-alt nav-icon"></i>
                                <p>All posts</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/blog/manage"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>New Post</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/blog/all2"
                                class="nav-link"><i class="fas fa-trash nav-icon"></i>
                                <p>Trash Post</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Products/E-Commerce<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/product/all"
                                class="nav-link"><i class="fas fa-box-open nav-icon"></i>
                                <p>All posts</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/product/manage"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>New Post</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Pages &amp; Menu<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/page/all"
                                class="nav-link"><i class="fas fa-file-alt nav-icon"></i>
                                <p>All pages</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/page/index"
                                class="nav-link"><i class="fas fa-plus nav-icon"></i>
                                <p>New Page</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/page/menu"
                                class="nav-link"><i class="fas fa-bars nav-icon"></i>
                                <p>Menu</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>System<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/system/allbackups"
                                class="nav-link"><i class="fas fa-database nav-icon"></i>
                                <p>Manage Backups</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/system/smtpemailsettings"
                                class="nav-link"><i class="fas fa-envelope nav-icon"></i>
                                <p>SMTP Email Settings</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/system/translate"
                                class="nav-link"><i class="fas fa-language nav-icon"></i>
                                <p>Auto Translate</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/system/emailtmpl"
                                class="nav-link"><i class="fas fa-edit nav-icon"></i>
                                <p>Edit Email Text</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/system/debugemail"
                                class="nav-link"><i class="fas fa-bug nav-icon"></i>
                                <p>Debug email</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/system/sitesettings"
                                class="nav-link"><i class="fas fa-cogs nav-icon"></i>
                                <p>Default Site Settings</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/system/settings"
                                class="nav-link"><i class="fas fa-cog nav-icon"></i>
                                <p>Web Admin Settings</p>
                            </a></li>
                        <li class="nav-item"><a href="https://www.funnewjersey.com/en/admin/system/generatesitemap"
                                class="nav-link"><i class="fas fa-sitemap nav-icon"></i>
                                <p>Site Map</p>
                            </a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Main Sidebar Container -->
