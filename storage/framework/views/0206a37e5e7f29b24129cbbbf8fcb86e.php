<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.cities'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(url('public/build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .hidden {
    display: none;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Admin
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            <?php echo app('translator')->get('translation.cities'); ?>
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="userList">
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
                                <?php if(auth()->guard('admin')->user()->rights != 3): ?>
                                    <a href="<?php echo e(route('cities.add')); ?>" class="btn btn-success add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i> Add City</a>
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

                                        <th class="sort" data-sort="name">Country Name</th>
                                        <th class="sort" data-sort="company_name">State Name</th>
                                        <th class="sort" data-sort="phone">City Name</th>
                                        <?php if(auth()->guard('admin')->user()->rights != 3): ?>
                                            <th class="sort" data-sort="action">Action</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <?php if(isset($users) && !empty($users)): ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php if(auth()->guard('admin')->user()->rights != 3): ?>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input delete_user_check" type="checkbox"
                                                            name="deleteuser[]" value="<?php echo e($val->id); ?>">
                                                    </div>
                                                </th>
                                            <?php endif; ?>
                                            <td  class="name"><?php echo e((isset($val->country) && !empty($val->country)) ? $val->country->title : ''); ?> </td>
                                            <td  class="company_name"><?php echo e((isset($val->state) && !empty($val->state)) ? $val->state->title : ''); ?> </td>
                                            <td  class="phone"><?php echo e(ucfirst($val->title)); ?> </td>
                                            <?php if(auth()->guard('admin')->user()->rights != 3): ?>
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top"
                                                            title="Edit">
                                                            <a class="edit-item-btn" href="<?php echo e(route('cities.edit',$val->id)); ?>"><i
                                                                    class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                        </li>
                                                        <li class="list-inline-item"
                                                            title="Delete">
                                                            <a class="remove-item-btn" href="javascript:void(0)" onclick="dms_modal.confirmModal('<?php echo e(url($actionURL.'/action/delete/'.$val->id)); ?>');">
                                                                <i
                                                                    class="ri-delete-bin-fill align-bottom text-muted"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            <?php endif; ?>
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
                            <?php echo e($users->links()); ?>

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
                                            <h4 class="fs-semibold">You are about to delete a city?</h4>
                                            <p class="text-muted fs-14 mb-4 pt-1">Deleting your city will
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
 
                    <!--end modal -->


                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(url('public/build/libs/list.js/list.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/build/js/pages/crm-leads.init.js')); ?>"></script>
    <script src="<?php echo e(url('public/build/js/app.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <script type="text/javascript">
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


        $(document).ready(function() {
    // $('#example').DataTable({
    //     "paging":   false,
    //     "searching" : false
    // });
    $('.search').keyup(function() {
    var table = $('#example').DataTable();
    table.search($(this).val()).draw();
});


    $('#example').dataTable({
  paging: false,
  "bFilter": true // show search input
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


});
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digicampus/public_html/dms.digicampus.app/resources/views/admin/city/index.blade.php ENDPATH**/ ?>