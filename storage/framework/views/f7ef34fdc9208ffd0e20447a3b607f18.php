<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.devotee'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public/backend/css/intlTelInput.css')); ?>" />
<link href="<?php echo e(url('public/build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .hidden {display: none;}
    #overlay{position:fixed;top:0;z-index:100;width:100%;height:100%;display:none;background:rgba(0,0,0,0.6);}
    .cv-spinner{height:100%;display:flex;justify-content:center;align-items:center;}
    .spinner{width:40px;height:40px;border:4px #ddd solid;border-top:4px #0d225f solid;border-radius:50%;animation:sp-anime 0.8s infinite linear;}
    @keyframes sp-anime{100%{transform:rotate(360deg);}}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            <?php echo app('translator')->get('translation.devotee'); ?>
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="devoteeList">
                <div class="card-header border-0">

                    <div class="row g-4 align-items-center">
                        <div class="col-sm-3">
                            <div class="search-box">
                                <input type="text" class="form-control search"
                                    placeholder="Search for...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-sm-auto ms-auto">
                            <div class="hstack gap-2">
                                <button class="btn btn-soft-danger" id="remove-actions" onclick="dms_modal.deletemultipleModal('<?php echo e(url($actionURL.'/multiple_delete/')); ?>');"><i class="ri-delete-bin-2-line"></i></button>
                                <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-bs-toggle="offcanvas"
                                    href="#offcanvasExample"><i
                                        class="ri-filter-3-line align-bottom me-1"></i> Fliters</button>
                                <?php if(auth()->guard('admin')->user()->rights != 3): ?>
                                    
                                    <button class="btn btn-outline-primary waves-effect waves-light export-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#exportModal" aria-controls="exportModal"><i
                                        class="ri-file-download-line align-bottom me-1"></i> <?php echo app('translator')->get('translation.export'); ?></button>
                                    <button class="btn btn-outline-primary waves-effect waves-light import-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#importModal" aria-controls="importModal"><i
                                        class="ri-file-upload-line align-bottom me-1"></i> <?php echo app('translator')->get('translation.import'); ?></button>
                                    <a href="<?php echo e(route('devotee.add')); ?>" class="btn btn-success add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i> Add <?php echo app('translator')->get('translation.devotee'); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card">
                            <table class="table align-middle" id="example">
                                <thead class="table-light">
                                    <tr>
                                        <?php if(auth()->guard('admin')->user()->rights != 3): ?>
                                            <th scope="col" style="width: 50px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkAll" value="option">
                                                </div>
                                            </th>
                                        <?php endif; ?>

                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Area/Village</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <?php if(isset($devotee) && !empty($devotee)): ?>
                                        <?php $__currentLoopData = $devotee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php if(auth()->guard('admin')->user()->rights != 3): ?>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input delete_user_check" type="checkbox"
                                                            name="deleteuser[]" value="<?php echo e($val->id); ?>">
                                                    </div>
                                                </th>
                                            <?php endif; ?>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <?php if(isset($val->image) && !empty($val->image)): ?>
                                                            <?php if(file_exists(public_path('/uploads/devotee_profile') . '/' . $val->image)): ?>
                                                            <img class="avatar-xxs rounded-circle image_src object-cover" src="<?php echo e(url('public/uploads/devotee_profile') . '/' . $val->image); ?>" alt="user-profile-image">
                                                            <?php else: ?>
                                                            <img class="avatar-xxs rounded-circle image_src object-cover" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <img class="avatar-xxs rounded-circle image_src object-cover" src="<?php echo e(url('public/build/images/users/user-dummy-img.png')); ?>" alt="user-profile-image">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2 name"><?php echo e(ucfirst($val->surname)); ?> <?php echo e(ucfirst($val->first_name)); ?> <?php echo e(ucfirst($val->last_name)); ?></div>
                                                </div>
                                            </td>
                                            <td>+<?php echo e($val->country_code); ?><?php echo e($val->mobile_no); ?></td>
                                            <td><?php echo e($val->area); ?></td>
                                            <td><?php echo e(isset($val->country->title) ? $val->country->title : ""); ?></td>
                                            <td><?php echo e(isset($val->state->title) ? $val->state->title : ""); ?></td>
                                            <td><?php echo e(isset($val->city->title) ? $val->city->title : ""); ?></td>
                                            
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item" data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover" data-bs-placement="top"
                                                        title="View">
                                                        <a class="edit-item-btn" href="<?php echo e(route('devotee.view',$val->id)); ?>"><i
                                                                class="ri-eye-fill align-bottom text-muted"></i></a>
                                                    </li>
                                                    <?php if(auth()->guard('admin')->user()->rights != 3): ?>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover" data-bs-placement="top"
                                                        title="Edit">
                                                        <a class="edit-item-btn" href="<?php echo e(route('devotee.edit',$val->id)); ?>"><i
                                                                class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover" data-bs-placement="top"
                                                        title="Delete">
                                                        <a class="remove-item-btn" onclick="dms_modal.confirmModal('<?php echo e(url($actionURL.'/action/delete/'.$val->id)); ?>');">
                                                            <i
                                                                class="ri-delete-bin-fill align-bottom text-muted"></i>
                                                        </a>
                                                    </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </td>
                                            
                                        </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                        trigger="loop" colors="primary:#121331,secondary:#08a88a"
                                        style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <?php echo e($devotee->links()); ?>

                        </div>
                    </div>
                    <!--end modal-->

                    <!-- Modal -->
                    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1"
                        aria-labelledby="deleteRecordLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close" id="btn-close"></button>
                                </div>
                                <form accept="" id="delete_form" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" id="multiple_userid" name="deleteuser" value="">
                                    <div class="modal-body p-5 text-center">
                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                            trigger="loop" colors="primary:#405189,secondary:#f06548"
                                            style="width:90px;height:90px"></lord-icon>
                                        <div class="mt-4 text-center">
                                            <h4 class="fs-semibold">You are about to delete a devotee?</h4>
                                            <p class="text-muted fs-14 mb-4 pt-1">Deleting your devotee will
                                                remove all of your information from our database.</p>
                                            <div class="hstack gap-2 justify-content-center remove">
                                                <button
                                                    class="btn btn-link link-success fw-medium text-decoration-none"
                                                    data-bs-dismiss="modal" id="deleteRecord-close"><i
                                                        class="ri-close-line me-1 align-middle"></i>
                                                    Close</button>
                                                <button class="btn btn-danger" id="delete-record">Yes,
                                                    Delete It!!</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                        aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header bg-light">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Devotee Fliters</h5>
                            <button type="button" class="btn-close text-reset"
                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <!--end offcanvas-header-->
                        <form action="" class="d-flex flex-column justify-content-end h-100">
                            <div class="offcanvas-body">
                                <div class="mb-4">
                                    <label for="first_name"
                                        class="form-label text-muted text-uppercase fw-semibold mb-3">First Name</label>
                                    <input type="text" name="name" value="<?php echo e($filter['name'] ?? ''); ?>" class="form-control" id="first_name" placeholder="Serach By First Name">
                                </div>
                                <div class="mb-4">
                                    <label for="mobile_no"
                                        class="form-label text-muted text-uppercase fw-semibold mb-3">Mobile Number</label>
                                    <!--<select class="form-control" name="mobile_no"
                                        id="mobile_no" data-choices data-choices-multiple-remove="true">
                                        <option value="">Select Mobile Number</option>
                                        <?php if(isset($mobileNo) && count($mobileNo) > 0): ?>
                                            <?php $__currentLoopData = $mobileNo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($val->mobile_no); ?>" <?php if(isset($filter['mobile_no']) && $filter['mobile_no'] == $val->mobile_no): ?> selected <?php endif; ?>>+<?php echo e($val->country_code); ?><?php echo e($val->mobile_no); ?></option>        
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>-->
                                    <input type="text" class="form-control onlyNumerics" id="mobile_no"
                                                    placeholder="Enter your phone number" name="mobile_no" value="<?php echo e($data->mobile_no ?? ''); ?>">
                                </div>
                                <div class="mb-4">
                                    <label for="datepicker-range"
                                        class="form-label text-muted text-uppercase fw-semibold mb-3">Date Of Birth</label>
                                    <input type="text" name="dob" value="<?php echo e($filter['dob'] ?? ''); ?>" class="form-control flatpickr-input" id="datepicker-range"
                                        data-provider="flatpickr" data-range="true"
                                        placeholder="Select Date Of Birth">
                                </div>
                                <div class="mb-4">
                                    <label for="status-select"
                                        class="form-label text-muted text-uppercase fw-semibold mb-3">Gender</label>
                                    <div class="row g-2">
                                        <div class="col-lg-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="gender" type="checkbox"
                                                    id="inlineRadio1" value="male" <?php if(isset($filter['gender']) && $filter['gender'] == 'male'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="inlineRadio1">Male </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="gender" type="checkbox"
                                                    id="inlineRadio2" value="female" <?php if(isset($filter['gender']) && $filter['gender'] == 'female'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="inlineRadio2">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="area" class="form-label text-muted text-uppercase fw-semibold mb-3">Area/Village</label>
                                    <?php echo Form::select('area[]',$area ?? '',$filter['area'] ?? '',[ 'class'=>'form-control','id'=>'area','data-select2init'=>'true','multiple'=>'true','data-placeholder'=>'Please Select']); ?>

                                </div>
                                <div class="mb-4">
                                    <label for="country_id" class="form-label text-muted text-uppercase fw-semibold mb-3">Country</label>
                                    <?php echo Form::select('country_id[]',$country ?? '',$filter['country_id'] ?? '',[ 'class'=>'form-control','id'=>'country_id','data-select2init'=>'true','multiple'=>'true','data-placeholder'=>'Please Select']); ?>

                                </div>
                                <div class="mb-4">
                                    <label for="state_id" class="form-label text-muted text-uppercase fw-semibold mb-3">State</label>
                                    <?php echo Form::select('state_id[]',$state ?? [],$filter['state_id'] ?? [],[ 'class'=>'form-control','id'=>'state_id','data-select2init'=>'true','multiple'=>'true','data-placeholder'=>'Please Select']); ?>

                                </div>
                                <div class="mb-4">
                                    <label for="city_id" class="form-label text-muted text-uppercase fw-semibold mb-3">City</label>
                                    <?php echo Form::select('city_id[]',$city ?? [],$filter['city_id'] ?? [],[ 'class'=>'form-control','id'=>'city_id','data-select2init'=>'true','multiple'=>'true','data-placeholder'=>'Please Select']); ?>

                                </div>
                                <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
                                    <a href="<?php echo e(url('admin/devotees')); ?>" class="btn btn-light w-100">Clear Filter</a>
                                    <button type="submit" class="btn btn-success w-100">Filters</button>
                                </div>
                            </div>
                            <!--end offcanvas-body-->
                            <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
                                <button class="btn btn-light w-100">Clear Filter</button>
                                <button type="submit" class="btn btn-success w-100">Filters</button>
                            </div>
                            <!--end offcanvas-footer-->
                        </form>
                    </div>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="exportModal" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header bg-light">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Export Devotee</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="<?php echo e(url($actionURL.'/export')); ?>" class="d-flex flex-column justify-content-end h-100">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="filterData" value="<?php echo e(json_encode($filter)); ?>">
                            <div class="offcanvas-body">
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="selectAll" id="checkAllExport">
                                    <label class="form-check-label" for="checkAllExport">Select all</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[Name]" id="colName">
                                    <label class="form-check-label" for="colName">Name</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[Image]" id="colImage">
                                    <label class="form-check-label" for="colImage">Image</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[Mobile]" id="colMobile">
                                    <label class="form-check-label" for="colMobile">Mobile</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[WhatsApp Number]" id="colWhatsApp">
                                    <label class="form-check-label" for="colWhatsApp">WhatsApp Number</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[DOB]" id="colDOB">
                                    <label class="form-check-label" for="colDOB">DOB</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[Gender]" id="colGender">
                                    <label class="form-check-label" for="colGender">Gender</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[Address]" id="colAddress">
                                    <label class="form-check-label" for="colAddress">Address</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[Area/Village]" id="colArea">
                                    <label class="form-check-label" for="colArea">Area/Village</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[Country]" id="colCountry">
                                    <label class="form-check-label" for="colCountry">Country</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[State]" id="colState">
                                    <label class="form-check-label" for="colState">State</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[City]" id="colCity">
                                    <label class="form-check-label" for="colCity">City</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input exportCol" type="checkbox" name="column[Created Date]" id="colCreated">
                                    <label class="form-check-label" for="colCreated">Created Date</label>
                                </div>
                                <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
                                    <button type="submit" name="export" class="btn btn-success w-100 btn-export" value="pdf">PDF</button>
                                    <button type="submit" name="export" class="btn btn-success w-100 btn-export" value="excel">Excel</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="importModal" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header bg-light">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Import Devotee</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <form id="importForm" method="POST" enctype="multipart/form-data" class="d-flex flex-column justify-content-end h-100">
                            <?php echo csrf_field(); ?>
                            <div class="offcanvas-body">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="excelFile">
                                </div>
                                <div class="alert alert-danger mt-2 importErrorMsg" role="alert" style="display: none;"></div>
                                <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
                                    <button type="button" class="btn btn-success w-100 btn-download">Download Sample</button>
                                    <button type="button" class="btn btn-success w-100 btn-import">Import</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--end modal -->
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    
    <script src="<?php echo e(url('public/build/libs/list.js/list.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
    
    <script src="<?php echo e(url('public/build/js/app.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="<?php echo e(url('public/backend/js/intlTelInput.min.js')); ?>"></script>
    <script src="<?php echo e(url('/public/build/libs/flatpickr/flatpickr.min.js')); ?>"></script>
    <script type="text/javascript">
        $("#datepicker-range").flatpickr({
            enableTime: false,
            dateFormat: "d-m-Y",
            mode: 'range',
            onChange: function(dates) {
                if (dates.length == 2) {
                    var start = dates[0];
                    var end = dates[1];
                    // interact with selected dates here
                }
            }
        });
        $(document).on('click', 'input[name="gender"]', function() {      
            $('input[name="gender"]').not(this).prop('checked', false);      
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
        function confirmModal(url, dynamicmsg = "") {
            if (dynamicmsg != "") {
                $(".dynamicmsg").html(dynamicmsg);
            }
            $("#deleteRecordModal").modal("show", { backdrop: "true" });
            $("#delete_form").attr("action", url);
        }
        $(document).on("submit", "#delete", function (event, url) {
            var u = $(this).attr("action");
        });
        $('.search').keyup(function() {
            var table = $('#example').DataTable();
            table.search($(this).val()).draw();
        });
        $('#example').dataTable({
            paging: false,
            "bFilter": true, // show search input
            language: {
                info: "Showing 1 to <?php echo e(count($devotee)); ?> of <?php echo e($totalDevotee); ?> entries"
            }
        });
        $("#example_filter").addClass("hidden"); // hidden search input
        $(".search").on("input", function (e) {
           e.preventDefault();
           $('#example').DataTable().search($(this).val()).draw();
        });
        $(document).on('click','.delete_user_check',function(){
            var checked_length = $('.delete_user_check').filter(':checked').length;
            $('#remove-actions').hide();
            if(checked_length > 0){
                $('#remove-actions').show();
            }
        });
        $(document).on('click','#checkAll',function(){
            var checked = $(this).prop('checked');
            $('.delete_user_check').prop('checked', checked);
            $('#remove-actions').hide();
            if(checked == true){
                $('#remove-actions').show();
            }
        });
    </script>
    <script type="text/javascript">
        $(function() {
            if($('select[data-select2init="true"]').length){
                $('select[data-select2init="true"]:not(.select2-hidden-accessible)').select2({width:'100%'});
            }
            select2OptgroupCheckout('country_id', '_country');
            select2OptgroupCheckout('state_id', '_state');
            select2OptgroupCheckout('city_id', '_city');
            $("#country_id").change(function() {
                $("#state_id").html("");
                var formData = new FormData();
                var selectedcountries = $(this).val();
                formData.append("country", JSON.stringify(selectedcountries));
                ajaxRequest("dropdown/country/states-options", formData).then(res => {
                    $("#state_id").html(res.data.html);
                    select2OptgroupCheckout('state_id', '_state');
                }).catch((err) => {
                    console.log(err);
                });
            });
            $("#state_id").change(function() {
                $("#city_id").html("");
                var formData = new FormData();
                var selectedcountries = $(this).val();
                formData.append("state", JSON.stringify(selectedcountries));
                ajaxRequest("dropdown/country/cities-options", formData).then(res => {
                    $("#city_id").html(res.data.html);
                    select2OptgroupCheckout('city_id', '_city');
                }).catch((err) => {
                    console.log(err);
                });
            });
            $("#state_id").select2({
                width:'100%',
                closeOnSelect:false,
                allowClear: true,
                tags: true
            });
            $("#city_id").select2({
                width:'100%',
                closeOnSelect:false,
                allowClear: true,
                tags: true
            });
        });
        function baseURL() {
            return $('base').attr('href');
        } 
        function getToken() {
            return $('meta[name="csrf-token"]').attr('content');
        }
        function ajaxRequest(reqURL,reqData,reqMethod = "",reqDataType = "") {
            return axios({
                baseURL: baseURL(),
                url: reqURL,
                method: (reqMethod != "") ? reqMethod : "post",
                headers: {'Content-Type': (reqDataType != "") ? reqDataType : "application/x-www-form-urlencoded"},
                data: reqData,
                async: false,
            });
        }
        function select2OptgroupCheckout(idSelectElement, staticWordInID){
            var Select2MultiCheckBoxObj = [];
            var idSelectElement = idSelectElement;
            var staticWordInID = staticWordInID;

            function AddItemInSelect2MultiCheckBoxObj(id, IsChecked) {
                if (Select2MultiCheckBoxObj.length > 0) {
                    let index = Select2MultiCheckBoxObj.findIndex(x => x.id == id);
                    if (index > -1) {
                        Select2MultiCheckBoxObj[index]["IsChecked"] = IsChecked;
                    }
                    else {
                        Select2MultiCheckBoxObj.push({ "id": id, "IsChecked": IsChecked });
                    }
                }
                else {
                    Select2MultiCheckBoxObj.push({ "id": id, "IsChecked": IsChecked });
                }
            }
            //Begin - Select 2 Multi-Select Code
            $.map($('#' + idSelectElement + ' option'), function (option) {
                AddItemInSelect2MultiCheckBoxObj(option.value, false);
            });
            function formatResult(ele) {
                if (Select2MultiCheckBoxObj.length > 0) {
                    var eleId = staticWordInID + ele.id;
                    let index = Select2MultiCheckBoxObj.findIndex(x => x.id == ele.id);
                    if (index > -1) {
                        var checkbox = $('<label class="lbl-checkbox cb-sm1" for="checkbox' + eleId + '"><input class="select2Checkbox" id="' + eleId + '" type="checkbox" ' + (Select2MultiCheckBoxObj[index]["IsChecked"] ? 'checked' : '') +
                            '/><span class="spn-checkbox"></span>' + ele.text + '</label>', { id: eleId });
                        return checkbox;
                    } else {
                        var checkbox = $('<label>' + ele.text + '</label>');
                        return checkbox;
                    }
                }
            }
        }
        $(document).on('click', '#checkAllExport', function () {
            var checked = $(this).prop('checked');
            $('.exportCol').prop('checked', checked);
        });
        $(document).on('click', '.btn-export', function (e) {
            if($('.exportCol:checked').length <= 0){
                Toastify({
                    newWindow: true,
                    text: "Please select at least one column!",
                    gravity: "top",
                    position: "right",
                    className: "bg-danger",
                    stopOnFocus: true,
                    duration: 3000,
                    close: true
                }).showToast();
                e.preventDefault();
            }else if($(this).val() == "pdf"){
                if($('.exportCol:checked').length > 5){
                    Toastify({
                        newWindow: true,
                        text: "You can select only 5 columns for pdf!",
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        stopOnFocus: true,
                        duration: 3000,
                        close: true
                    }).showToast();
                    e.preventDefault();
                }
            }
        });
        $(document).on('click', '.btn-download', function (e) {
            window.open('<?php echo e(route('devotee.downloadSample')); ?>', '_blank');
        });
        $(document).on('click', '.btn-import', function (e) {
            var file = $("input[name='excelFile']")[0].files;
            if(file.length > 0){
                var filename = file[0].name;
                var extension = filename.substr(filename.lastIndexOf("."));
                var allowedExtensionsRegx = /(\.xls|\.xlsx)$/i;
                if(!allowedExtensionsRegx.test(extension)){
                    Toastify({
                        newWindow: true,
                        text: "Please upload valid excel file!",
                        gravity: "top",
                        position: "right",
                        className: "bg-danger",
                        stopOnFocus: true,
                        duration: 3000,
                        close: true
                    }).showToast();
                }else{
                    $("#overlay").show();
                    var formData = new FormData();
                    formData.append('file',file[0]);
                    formData.append('_token',getToken());
                    ajaxRequest("admin/devotees/import", formData).then(res => {
                        if(res.data.success){
                            if(res.data.rows == 0){
                                Toastify({
                                    newWindow: true,
                                    text: res.data.message,
                                    gravity: "top",
                                    position: "right",
                                    className: "bg-success",
                                    stopOnFocus: true,
                                    duration: 3000,
                                    close: true
                                }).showToast();
                                window.location.reload();
                            }else{
                                if(res.data.statusMsg){
                                    $("#overlay").hide();
                                    $(".importErrorMsg").text(res.data.statusMsg);
                                    $(".importErrorMsg").show();
                                }
                            }
                        }
                    }).catch((err) => {
                        $("#overlay").hide();
                        Toastify({
                            newWindow: true,
                            text: "Something went wrong!",
                            gravity: "top",
                            position: "right",
                            className: "bg-danger",
                            stopOnFocus: true,
                            duration: 3000,
                            close: true
                        }).showToast();
                        // console.log(err);
                    });
                }
            }else{
                Toastify({
                    newWindow: true,
                    text: "Please select file!",
                    gravity: "top",
                    position: "right",
                    className: "bg-danger",
                    stopOnFocus: true,
                    duration: 3000,
                    close: true
                }).showToast();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digicampus/public_html/dms.digicampus.app/resources/views/admin/devotee/index.blade.php ENDPATH**/ ?>