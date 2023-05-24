<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public/backend/css/intlTelInput.css')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="<?php echo e(url('public/images/cover_image.png')); ?>" class="profile-wid-img" alt="">
            
        </div>
    </div>
<form action="<?php echo e(route('update_profile')); ?>" enctype="multipart/form-data" id="editaccountsettings" method="post">
    <?php echo csrf_field(); ?>
    <div class="row">
        
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                <input type="hidden" id="cover_img_hidden" value="<?php echo e($user->cover_image ?? ''); ?>">
                                                <?php if(isset($user->cover_image) && !empty($user->cover_image)): ?>
                                                    <?php if(file_exists(public_path('/uploads/user_profile') . '/' . $user->cover_image)): ?>
                                                    
                                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="<?php echo e(url('public/uploads/user_profile') . '/' . $user->cover_image); ?>" alt="user-profile-image">
                                                    <?php else: ?>
                                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
                                                <?php endif; ?>
                                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                    <input id="profile-img-file-input" type="file" name="cover_image" class="profile-img-file-input">
                                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                        <span class="avatar-title rounded-circle bg-light text-body">
                                                            <i class="ri-camera-fill"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="avatar-xs p-0 rounded-circle profile-photo-delete">
                                                    <label class="profile-photo-delete avatar-xs">
                                                        <span class="avatar-title-delete rounded-circle bg-light text-body">
                                                            <i class=" ri-close-circle-line"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                       <h6>Upload Profile Image</h6>
                                    <h6>(Less than 5mb)</h6>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            
                                
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">User
                                                Name<span class="error">*</span></label>
                                            <input type="text" class="form-control" id="username"
                                                placeholder="Enter your username" name="username" value="<?php echo e($user->name ?? ''); ?>">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                            <label for="mobile_no" class="form-label">Mobile
                                                Number<span class="error">*</span></label>
                                            <div>
                                            <input type="text" class="form-control onlyNumerics" id="mobile_no"
                                                placeholder="Enter your phone number" name="mobile_no" value="<?php echo e($user->mobile_no ?? ''); ?>">
                                            </div>
                                    </div>
                                    <input type="hidden" id="user_hidden_id" value="<?php echo e($user->id ?? ''); ?>">
                                    <input type="hidden" name="con_code" id="con_code" value="">
                                    <input type="hidden" name="con_flag" id="con_flag" value="">
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email
                                                ID<span class="error">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter your email" value="<?php echo e($user->email ?? ''); ?>" readonly>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    
                                   

                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="<?php echo e(route('change-password')); ?>" id="confirmnewpasswordform" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="old_password" class="form-label">Old
                                                Password<span class="error">*</span></label>
                                            <input type="password" name="old_password" class="form-control" id="old_password"
                                                placeholder="Enter old password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="password" class="form-label">New
                                                Password<span class="error">*</span></label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="confirm_password" class="form-label">Confirm
                                                Password<span class="error">*</span></label>
                                            <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                                                placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Change
                                                Password</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(url('public/build/js/pages/profile-setting.init.js')); ?>"></script>
    <script src="<?php echo e(url('public/backend/js/intlTelInput.min.js')); ?>"></script>
    <script type="text/javascript">
    let phoneInputField = document.querySelector("#mobile_no");
    let phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "in",
        hiddenInput:'full',
        formatOnDisplay:false,
        utilsScript:"<?php echo e(url('public/backend/js/utils.js')); ?>",
        autoPlaceholder: "ON",
    });

    <?php if( isset($user['country_flag']) && !empty($user['country_flag']) ): ?>
    phoneInput.setCountry("<?php echo e($user['country_flag']); ?>");
    <?php endif; ?>

    $(document).on('click','.avatar-title-delete',function(){
        var default_image = "<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>";
        var $el = $('#profile-img-file-input');
        $('.user-profile-image').attr("src",default_image);
        $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
    });

    $(document).on('click','#profile-img-file-input',function(){
            $('.profile-photo-delete').show();
    });

    $(document).on('click','.profile-photo-delete',function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: "<?php echo e(route('devotee.delete_user_image')); ?>",
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('#user_hidden_id').val(),
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {
                }
            });
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dms\resources\views/admin/profile.blade.php ENDPATH**/ ?>