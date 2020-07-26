<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">St Jude ERP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $sidebarSection == 'dashboard' ? 'active' : '';?>">
    <a class="nav-link" href="<?= BASEPAGES;?>index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Modules
    </div>

    <!-- Nav Item - CATEGORY Collapse Menu -->
    <li class="nav-item <?= $sidebarSection=='category' ? 'active' : '';?>">
    <a class="nav-link <?= $sidebarSection=='category' ? '' : 'collapsed';?>" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
        <i class="fas fa-fw fa-cog"></i>
        <span>Category</span>
    </a>
    <div id="collapseCategory" class="collapse <?= $sidebarSection=='category' ? 'show' : '';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?= $sidebarSubSection== 'add-category' ? 'active' : '';?>" href="<?=BASEPAGES;?>add-category.php">Add Category</a>
        <a class="collapse-item <?= $sidebarSubSection== 'manage-category' ? 'active' : '';?>" href="<?=BASEPAGES;?>manage-category.php">Manage Category</a>
        </div>
    </div>
    </li>

    <!-- Nav Item - PRODUCT Collapse Menu -->
    <li class="nav-item <?= $sidebarSection=='product' ? 'active' : '';?>">
    <a class="nav-link <?= $sidebarSection=='product' ? '' : 'collapsed';?>" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
        <i class="fas fa-fw fa-cog"></i>
        <span>Product</span>
    </a>
    <div id="collapseProduct" class="collapse <?= $sidebarSection=='product' ? 'show' : '';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?= $sidebarSubSection== 'add-product' ? 'active' : '';?>" href="<?=BASEPAGES;?>add-product.php">Add Product</a>
        <a class="collapse-item <?= $sidebarSubSection== 'manage-product' ? 'active' : '';?>" href="<?=BASEPAGES;?>manage-product.php">Manage Product</a>
        </div>
    </div>
    </li>

    <!-- Nav Item - CUSTOMER Collapse Menu -->
    <li class="nav-item <?= $sidebarSection=='customer' ? 'active' : '';?>">
    <a class="nav-link <?= $sidebarSection=='customer' ? '' : 'collapsed';?>" href="#" data-toggle="collapse" data-target="#collapseCustomer" aria-expanded="true" aria-controls="collapseCustomer">
        <i class="fas fa-fw fa-cog"></i>
        <span>Patients</span>
    </a>
    <div id="collapseCustomer" class="collapse <?= $sidebarSection=='customer' ? 'show' : '';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?= $sidebarSubSection== 'add-customer' ? 'active' : '';?>" href="<?=BASEPAGES;?>add-customer.php">Add Patients</a>
        <a class="collapse-item <?= $sidebarSubSection== 'manage-customer' ? 'active' : '';?>" href="<?=BASEPAGES;?>manage-customer.php">Manage
            Patients</a>
        </div>
    </div>
    </li>

    <!-- Nav Item - SUPPLIER Collapse Menu -->
    <li class="nav-item <?= $sidebarSection=='supplier' ? 'active' : '';?>">
    <a class="nav-link <?= $sidebarSection=='supplier' ? '' : 'collapsed';?>" href="#" data-toggle="collapse" data-target="#collapseSupplier" aria-expanded="true" aria-controls="collapseSupplier">
        <i class="fas fa-fw fa-cog"></i>
        <span>Donor</span>
    </a>
    <div id="collapseSupplier" class="collapse <?= $sidebarSection=='supplier' ? 'show' : '';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?= $sidebarSubSection== 'add-supplier' ? 'active' : '';?>" href="<?=BASEPAGES;?>add-supplier.php">Add Donor</a>
        <a class="collapse-item <?= $sidebarSubSection== 'manage-supplier' ? 'active' : '';?>" href="<?=BASEPAGES;?>manage-supplier.php">Manage
            Donor</a>
        </div>
    </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>