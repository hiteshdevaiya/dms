<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.cities'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0"><?php echo e((isset($data) && !empty($data->id)) ? 'Update' : 'Add'); ?> City</h4>
            </div>

            <?php if(isset($data) && !empty($data->id)): ?>
                <?php $id = $data->id; ?>
            <?php else: ?>
                <?php $id = 0;?>
            <?php endif; ?>
            <form class="tablelist-form" method="POST" enctype="multipart/form-data" action="<?php echo e(url($actionURL.'/action',$view).'/'.$id ?? 0); ?>" autocomplete="off" id="cityform">
            <?php echo csrf_field(); ?>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="country_id" class="form-label">Select Country<span class="error">*</span></label>
                                <?php echo Form::select('country_id',$country ?? '',$data->country_id ?? '',['class'=>'form-control','id'=>'country_id','placeholder'=>'Select Country']); ?>

                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="state_id" class="form-label">Select State<span class="error">*</span></label>
                                <?php echo Form::select('state_id',$state ?? [],$data->state_id ?? '',['class'=>'form-control','id'=>'state_id','placeholder'=>'Select State']); ?>

                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <div>
                                <label for="title"
                                    class="form-label">Title<span class="error">*</span></label>
                                <input type="text" id="title" name="title"
                                    class="form-control" placeholder="Enter city name"
                                    value="<?php echo e($data->title ?? ''); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <a href="<?php echo e(route('states')); ?>" class="btn btn-light">Close</a>
                        <button type="submit" class="btn btn-success"
                            id="add-btn"><?php echo e((isset($data) && !empty($data->id)) ? 'Update' : 'Add'); ?> City</button>
                    </div>
                </div>
            </form>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">


    $(document).on("change","#country_id",function() {
        country_id = this.value;
        changecountry(country_id);
    });

    function changecountry(country_id) {
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
        }
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dms\resources\views/admin/city/create.blade.php ENDPATH**/ ?>