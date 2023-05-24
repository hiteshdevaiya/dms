<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?php echo e(url('public/images/logo.svg')); ?>" alt="" height="100">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(url('public/images/logo.svg')); ?>" alt="" height="100">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?php echo e(url('public/images/logo.svg')); ?>" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(url('public/images/logo.svg')); ?>" alt="" height="100">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <?php if(isset(auth()->guard('admin')->user()->cover_image) && !empty(auth()->guard('admin')->user()->cover_image)): ?>
                                <?php if(file_exists(public_path('/uploads/user_profile') . '/' . auth()->guard('admin')->user()->cover_image)): ?>
                                <img class="rounded-circle header-profile-user" src="<?php echo e(url('public/uploads/user_profile') . '/' . auth()->guard('admin')->user()->cover_image); ?>" alt="user-profile-image">
                                <?php else: ?>
                                <img class="rounded-circle header-profile-user" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
                                <?php endif; ?>
                            <?php else: ?>
                                <img class="rounded-circle header-profile-user" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
                            <?php endif; ?>
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo e(ucfirst(auth()->guard('admin')->user()->name) ?? ""); ?></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome <?php echo e(ucfirst(auth()->guard('admin')->user()->name) ?? ""); ?>!</h6>
                        <a class="dropdown-item" href="<?php echo e(route('profile')); ?>"><i class="ri-shield-user-line text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                        <a class="dropdown-item " href="<?php echo e(route('logout')); ?>"><i class="bx bx-power-off font-size-16 align-middle me-1"></i> <span key="t-logout"><?php echo app('translator')->get('translation.logout'); ?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\xampp\htdocs\dms\resources\views/layouts/topbar.blade.php ENDPATH**/ ?>