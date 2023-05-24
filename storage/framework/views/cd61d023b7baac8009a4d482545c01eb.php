<?php

global $path;

global $currentPath;



$path = Route::getFacadeRoot()->current()->uri();

$currentPathTemp = Request::fullUrl();

$currentPathTemp = explode(url('/').'/', $currentPathTemp);



$currentPath = '';

if( isset($currentPathTemp[1]) ):

$currentPath = $currentPathTemp[1];

$currentPath = trim($currentPath);

endif;



function getActiveRoute( $arrayLinks ){

$selected = false;

if( in_array($GLOBALS['path'], $arrayLinks) ):

$selected = true;

elseif ( in_array($GLOBALS['currentPath'], $arrayLinks) ):

$selected = true;

endif;

return $selected;

}

?>





<!-- ========== App Menu ========== -->

<div class="app-menu navbar-menu">

    <!-- LOGO -->

    <div class="navbar-brand-box" style="background: #0d225f;">

        <!-- Dark Logo-->

        <a href="index" class="logo logo-dark">

            <span class="logo-sm">

                <img src="<?php echo e(url('public/images/logo.svg')); ?>" alt="" height="100">

            </span>

            <span class="logo-lg">

                <img src="<?php echo e(url('public/images/logo.svg')); ?>" alt="" height="100">

            </span>

        </a>

        <!-- Light Logo-->

        <a href="<?php echo e(url('admin/dashboard')); ?>" class="logo logo-light">

            <span class="logo-sm">

                <img src="<?php echo e(url('public/images/logo.svg')); ?>" alt="" height="50">

            </span>

            <span class="logo-lg">

                <img src="<?php echo e(url('public/images/logo.svg')); ?>" alt="" height="100">

            </span>

        </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">

            <i class="ri-record-circle-line"></i>

        </button>

    </div>



    <div id="scrollbar">

        <div class="container-fluid">



            <div id="two-column-menu">

            </div>

            <ul class="navbar-nav" id="navbar-nav">

                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>



                <?php

                    $links_array = [

                    'admin/dashboard',

                    ];

                    $selected = getActiveRoute($links_array);

                ?>



                <li class="nav-item">

                    <a class="nav-link menu-link <?php if( $selected ): ?> active <?php endif; ?>" href="<?php echo e(url('admin/dashboard')); ?>">

                        <i class="ri-dashboard-2-line"></i> <span><?php echo app('translator')->get('translation.dashboard'); ?></span>

                    </a>

                </li>



                <?php

                    $links_array = [

                    'admin/users',

                    'admin/users/add',

                    'admin/users/edit/{id}',

                    ];

                    $selected = getActiveRoute($links_array);

                ?>

                <?php if(auth()->guard('admin')->user()->rights == 1): ?>

                    <li class="nav-item">

                        <a class="nav-link menu-link <?php if( $selected ): ?> active <?php endif; ?>" href="<?php echo e(url('admin/users')); ?>">

                            <i class="ri-shield-user-line"></i> <span><?php echo app('translator')->get('translation.users'); ?></span>

                        </a>

                    </li>

                <?php endif; ?>



                <?php

                    $links_array = [

                    'admin/devotees',

                    'admin/devotees/add',

                    'admin/devotees/edit/{id}',

                    ];

                    $selected = getActiveRoute($links_array);

                ?>

                <li class="nav-item">

                    <a class="nav-link menu-link <?php if( $selected ): ?> active <?php endif; ?>" href="<?php echo e(url('admin/devotees')); ?>">

                        <i class="ri-group-line"></i> <span><?php echo app('translator')->get('translation.devotee'); ?></span>

                    </a>

                </li>





                <?php

                    $links_array = [

                    'admin/countries',

                    'admin/countries/add',

                    'admin/countries/edit/{id}',

                    ];

                    $selected = getActiveRoute($links_array);

                ?>

                <li class="nav-item">

                    <a class="nav-link menu-link <?php if( $selected ): ?> active <?php endif; ?>" href="<?php echo e(url('admin/countries')); ?>">

                        <i class="ri-user-location-fill"></i> <span><?php echo app('translator')->get('translation.countries'); ?></span>

                    </a>

                </li>





                <?php

                    $links_array = [

                    'admin/states',

                    'admin/states/add',

                    'admin/states/edit/{id}',

                    ];

                    $selected = getActiveRoute($links_array);

                ?>

                <li class="nav-item">

                    <a class="nav-link menu-link <?php if( $selected ): ?> active <?php endif; ?>" href="<?php echo e(url('admin/states')); ?>">

                        <i class="ri-user-location-fill"></i> <span><?php echo app('translator')->get('translation.states'); ?></span>

                    </a>

                </li>



                <?php

                    $links_array = [

                    'admin/cities',

                    'admin/cities/add',

                    'admin/cities/edit/{id}',

                    ];

                    $selected = getActiveRoute($links_array);

                ?>

                <li class="nav-item">

                    <a class="nav-link menu-link <?php if( $selected ): ?> active <?php endif; ?>" href="<?php echo e(url('admin/cities')); ?>">

                        <i class="ri-user-location-fill"></i> <span><?php echo app('translator')->get('translation.cities'); ?></span>

                    </a>

                </li>



            </ul>

        </div>

        <!-- Sidebar -->

    </div>

    <div class="sidebar-background"></div>

</div>

<!-- Left Sidebar End -->

<!-- Vertical Overlay-->

<div class="vertical-overlay"></div>

<?php /**PATH /home/digicampus/public_html/dms.digicampus.app/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>