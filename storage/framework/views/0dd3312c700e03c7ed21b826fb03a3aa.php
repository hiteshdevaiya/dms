<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.admin'); ?>
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
     <?php if(isset($data) && !empty($data->id)): ?>
        <?php $id = $data->id; ?>
    <?php else: ?>
        <?php $id = 0;?>
    <?php endif; ?>
    <form class="tablelist-form" method="POST" enctype="multipart/form-data" action="<?php echo e(url($actionURL.'/action',$view).'/'.$id ?? 0); ?>" autocomplete="off" id="userform">
            <?php echo csrf_field(); ?>
        <div class="row">            
            <div class="col-xxl-3">
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                        <input type="hidden" id="cover_img_hidden" value="<?php echo e($data->cover_image ?? ''); ?>">
                                        <?php if(isset($data->cover_image) && !empty($data->cover_image)): ?>
                                            <?php if(file_exists(public_path('/uploads/user_profile') . '/' . $data->cover_image)): ?>
                                            <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="<?php echo e(url('public/uploads/user_profile') . '/' . $data->cover_image); ?>" alt="user-profile-image">
                                            <?php else: ?>
                                            <img class="rounded-circle avatar-xl img-thumbnail user-profile-update-image" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(isset($id) && !empty($id)): ?>
                                                <img class="rounded-circle avatar-xl img-thumbnail user-profile-update-image" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
                                            <?php else: ?>
                                                <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                            <input id="profile-img-file-input" type="file" name="cover_image" class="profile-img-file-input">
                                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                <span class="avatar-title rounded-circle bg-light text-body">
                                                    <i class="ri-camera-fill"></i>
                                                </span>
                                            </label>
                                        </div>
                                        <?php if(isset($id) && !empty($id)): ?>
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-delete">
                                                <label class="profile-photo-delete avatar-xs">
                                                    <span class="avatar-title-delete rounded-circle bg-light text-body">
                                                        <i class=" ri-close-circle-line"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        <?php else: ?>
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-delete" style="display: none;">
                                                <label class="profile-photo-delete avatar-xs">
                                                    <span class="avatar-title-delete rounded-circle bg-light text-body">
                                                        <i class=" ri-close-circle-line"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        <?php endif; ?>

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
                        </ul>
                    </div>
                    <input type="hidden" id="user_hidden_id" value="<?php echo e($data->id ?? ''); ?>">
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">User
                                                    Name<span class="error">*</span></label>
                                                <input type="text" class="form-control" id="username"
                                                    placeholder="Enter your username" name="username" value="<?php echo e($data->name ?? ''); ?>">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="mobile_no" class="form-label">Mobile
                                                    Number<span class="error">*</span></label>
                                                <div>
                                                <input type="text" class="form-control onlyNumerics" id="mobile_no"
                                                    placeholder="Enter your phone number" name="mobile_no" value="<?php echo e($data->mobile_no ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="con_code" id="con_code" value="">
                                        <input type="hidden" name="con_flag" id="con_flag" value="">
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email
                                                    ID<span class="error">*</span></label>
                                                <?php if(isset($data) && !empty($data->email)): ?>
                                                    <input type="text" name="email"
                                                    class="form-control"
                                                    placeholder="Enter email" value="<?php echo e($data->email ?? ''); ?>" readonly="" />
                                                <?php else: ?>
                                                    <input type="text" id="email" name="email"
                                                    class="form-control"
                                                    placeholder="Enter email">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if(isset($data) && !empty($data->password)): ?>
                                        <?php else: ?>
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
                                        <?php endif; ?>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="designationInput" class="form-label">Rights<span class="error">*</span></label>
                                                <?php if(isset($rights) && !empty($rights)): ?>
                                                <?php $__currentLoopData = $rights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $checked = ''; ?>
                                                <?php if(isset($data) && ($data->rights == $val->id)): ?>
                                                    <?php $checked = 'checked'; ?>
                                                <?php endif; ?>
                                                <div class="form-check form-radio-primary mb-3">
                                                    <input class="form-check-input rights" type="radio" name="rights" id="rights" value="<?php echo e($val->id); ?>" <?php echo e($checked ?? ''); ?>>
                                                    <label class="form-check-label">
                                                        <?php echo e($val->name); ?>

                                                    </label>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="status_field" class="form-label">Status<span class="error">*</span></label>
                                                <select class="form-select mb-3" name="status_field" id="status_field" aria-label="Default select example">
                                                   <option value="">Select Status </option>
                                                    <option value="active" <?php echo e((isset($data) && ($data->status == 'active')) ? 'selected' : ''); ?>>Active</option>
                                                    <option value="inactive" <?php echo e((isset($data) && ($data->status == 'inactive')) ? 'selected' : ''); ?>>Inactive</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="<?php echo e(route('users')); ?>" class="btn btn-light">Close</a>
                                                <button type="submit" class="btn btn-primary"><?php echo e((isset($data) && !empty($data->id)) ? 'Update' : 'Add'); ?> User</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                            </div>
                            <!--end tab-pane-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </form>
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

    <?php if( isset($data['country_flag']) && !empty($data['country_flag']) ): ?>
    phoneInput.setCountry("<?php echo e($data['country_flag']); ?>");
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digicampus/public_html/dms.digicampus.app/resources/views/admin/user/create.blade.php ENDPATH**/ ?>