<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.devotee'); ?>
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
    <form class="tablelist-form" method="POST" enctype="multipart/form-data" action="<?php echo e(url($actionURL.'/action',$view).'/'.$id ?? 0); ?>" autocomplete="off" id="devoteeform">
            <?php echo csrf_field(); ?>
        <div class="row">            
            <div class="col-xxl-3">
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                <?php if(isset($data->image) && !empty($data->image)): ?>
                                    <?php if(file_exists(public_path('/uploads/devotee_profile') . '/' . $data->image)): ?>
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="<?php echo e(url('public/uploads/devotee_profile') . '/' . $data->image); ?>" alt="user-profile-image">
                                    <?php else: ?>
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
                                    <?php endif; ?>
                                <?php else: ?>
                                <?php if(isset($id) && !empty($id)): ?>
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
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
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="surname" class="form-label">Surname<span class="error">*</span></label>
                                                <input type="text" id="surname" name="surname" class="form-control" placeholder="Enter Surname" value="<?php echo e($data->surname ?? ''); ?>" />
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">First Name<span class="error">*</span></label>
                                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter First Name" value="<?php echo e($data->first_name ?? ''); ?>" />
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">Last Name (Husband / Father)<span class="error">*</span></label>
                                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter Last Name" value="<?php echo e($data->last_name ?? ''); ?>" />
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
                                        <input type="hidden" id="edit_type" value="<?php echo e((isset($data) && !empty($data)) ? 'edit' : 'add'); ?>">
                                        <input type="hidden" id="devotee_hidden_id" value="<?php echo e($data->id ?? ''); ?>">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="whatsapp_no" class="form-label">WhatsApp Number</label>
                                                <div>
                                                <input type="text" class="form-control onlyNumerics" id="whatsapp_no"
                                                    placeholder="Enter your whatsApp number" name="whatsapp_no" value="<?php echo e($data->whatsapp_no ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="whatsapp_con_code" id="whatsapp_con_code" value="">
                                        <input type="hidden" name="whatsapp_con_flag" id="whatsapp_con_flag" value="">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                               <label for="datepicker-range" class="form-label">Date Of Birth</label>
                                               <?php if(isset($data->dob) && !empty($data->dob)): ?>
                                               <?php $dob = date('d-m-Y', strtotime($data->dob)); ?>
                                               <?php endif; ?>
                                                <input type="text" name="dob" value="<?php echo e($dob ?? ''); ?>" class="form-control flatpickr-input" id="dob" data-provider="flatpickr" data-range="true" placeholder="Select Date Of Birth">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" value="male" <?php echo e((isset($data) && ($data->gender == 'male')) ? 'checked' : ''); ?>>
                                                            <label class="form-check-label">
                                                                Male
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" value="female" <?php echo e((isset($data) && ($data->gender == 'female')) ? 'checked' : ''); ?>>
                                                            <label class="form-check-label">
                                                                Female
                                                            </label>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" id="address" name="address" class="form-control" placeholder="Enter Address" value="<?php echo e($data->address ?? ''); ?>" />
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="area" class="form-label">Area/Village</label>
                                                <input type="text" id="area" name="area" class="form-control" placeholder="Enter Area/Village" value="<?php echo e($data->area ?? ''); ?>" />
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="country_id" class="form-label">Select Country</label>
                                                <?php echo Form::select('country_id',$country ?? '',$data->country_id ?? '',['class'=>'form-control','id'=>'country_id','placeholder'=>'Select Country']); ?>

                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="state_id" class="form-label">Select State</label>
                                                <?php echo Form::select('state_id',$state ?? [],$data->state_id ?? '',['class'=>'form-control','id'=>'state_id','placeholder'=>'Select State']); ?>

                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="city_id" class="form-label">Select City</label>
                                                <?php echo Form::select('city_id',$city ?? [],$data->city_id ?? '',['class'=>'form-control','id'=>'city_id','placeholder'=>'Select City']); ?>

                                            </div>
                                        </div>
    
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="<?php echo e(route('devotee')); ?>" class="btn btn-light">Close</a>
                                                <button type="submit" class="btn btn-primary"><?php echo e((isset($data) && !empty($data->id)) ? 'Update' : 'Add'); ?> Devotee</button>
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
    <script src="<?php echo e(url('/public/build/libs/flatpickr/flatpickr.min.js')); ?>"></script>
    
    <script src="<?php echo e(url('public/backend/js/intlTelInput.min.js')); ?>"></script>
    <script type="text/javascript">
        $("#dob").flatpickr({
    enableTime: false,
    dateFormat: "d-m-Y",
});
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

    //for whatsapp no
    let phoneInputField1 = document.querySelector("#whatsapp_no");
    let phoneInput1 = window.intlTelInput(phoneInputField1, {
        initialCountry: "in",
        hiddenInput:'full',
        formatOnDisplay:false,
        utilsScript:"<?php echo e(url('public/backend/js/utils.js')); ?>",
        autoPlaceholder: "ON",
    });

    <?php if( isset($data['wh_country_flag']) && !empty($data['wh_country_flag']) ): ?>
    phoneInput1.setCountry("<?php echo e($data['wh_country_flag']); ?>");
    <?php endif; ?>

    $(document).on("change","#country_id",function() {
        country_id = this.value;
        changecountry(country_id);
    });


    $(document).on("change","#state_id",function() {
        state_id = this.value;
        country_id = $('#country_id').val();
        changestate(country_id,state_id);
    });

    function changecountry(country_id) {
        $("#city_id").html('<option value="">Select City</option>');
        $("#state_id").html('<option value="">Select State</option>');
        // Here we can get the value of selected item
        if (country_id != '') {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: dms_app.baseURL() + '/getstate',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    country_id: country_id,
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {
                    if (data != '') {
                        $("#state_id").html(data);
                    }
                }
            });
        } else {
            $("#city_id").html('<option value="">Select City</option>');
            $("#state_id").html('<option value="">Select State</option>');
        }
    }


    function changestate(country_id,state_id) {
        $("#city_id").html('<option value="">Select City</option>');
        // Here we can get the value of selected item
        if (country_id != '' && state_id != '') {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: dms_app.baseURL() + '/getcity',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    country_id: country_id,
                    state_id: state_id,
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {
                    if (data != '') {
                        $("#city_id").html(data);
                    }
                }
            });
        } else {
            $("#city_id").html('<option value="">Select City</option>');
        }
    }

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
                url: "<?php echo e(route('devotee.delete_devotee_image')); ?>",
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('#devotee_hidden_id').val(),
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {
                }
            });
    });
    $(document).on('focus','#whatsapp_no',function(){
        $(this).val($("#mobile_no").val());
        let phoneInputField1 = document.querySelector("#whatsapp_no");
        let phoneInput1 = window.intlTelInput(phoneInputField1, {
            initialCountry: phoneInput.s.iso2,
            hiddenInput:'full',
            formatOnDisplay:false,
            utilsScript:"<?php echo e(url('public/backend/js/utils.js')); ?>",
            autoPlaceholder: "ON",
        });
    });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digicampus/public_html/dms.digicampus.app/resources/views/admin/devotee/create.blade.php ENDPATH**/ ?>