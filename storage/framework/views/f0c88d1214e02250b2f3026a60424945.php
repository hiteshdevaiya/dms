<!doctype html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-topbar="light" data-sidebar-image="none">



    <head>

    <base href="<?php echo e(url('/')); ?>">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <meta charset="utf-8" />

    <title>SGVP | Digi Campus</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta content="Themesbrand" name="author" />

    <!-- App favicon -->

    <link rel="shortcut icon" href="<?php echo e(url('public/images/logo.svg')); ?>">

        <?php echo $__env->make('layouts.head-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

        <script src="<?php echo e(url('public/js/dms.min.js')); ?>"></script>

        

  </head>

    <?php echo $__env->yieldContent('body'); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('layouts.vendor-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </body>

</html>

<?php /**PATH C:\xampp\htdocs\dms\resources\views/layouts/master-without-nav.blade.php ENDPATH**/ ?>