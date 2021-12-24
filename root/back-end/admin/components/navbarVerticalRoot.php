<!-- Awal Navbar Vertical -->
<nav class="navbar navbar-expand-lg navbar-white bg-white">
    <button type="button" id="sidebarCollapse" class="btn btn-light">
        <i class="fas fa-bars"></i><span></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ms-auto">


            <!-- Awal Shortcut -->
            <li class="nav-item dropdown">
                <div class="nav-dropdown">
                    <a href="#" id="nav1" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-link"></i> <span> Shortcut</span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end nav-link-menu" aria-labelledby="nav1">
                        <ul class="nav-list">
                            <li><a href="../index.php" class="dropdown-item"><i class="fas fa-home"></i> Halaman Utama</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a href="form/addUser.php" class="dropdown-item"><i class="fas fa-user-plus"></i> Tambah User</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a href="form/addProduct.php" class="dropdown-item"><i class="fas fa-folder-plus"></i> Tambah Produk</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <!-- Akhir Shortcut -->


            <!-- Awal Profile -->
            <li class="nav-item dropdown">
                <div class="nav-dropdown">
                    <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> <span><?= getInfo('nama') ?></span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                        <ul class="nav-list">
                        <li><a href="form/editUser.php?user_id=<?= getInfo('id') ?>" class="dropdown-item"><i class="fas fa-address-card"></i> Edit Profile</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a href="php/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <!-- Awal Profile -->


        </ul>
    </div>
</nav>
<!-- Akhir Navbar Vertical -->