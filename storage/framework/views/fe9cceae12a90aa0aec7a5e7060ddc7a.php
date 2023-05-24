<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.countries'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0"><?php echo e((isset($data) && !empty($data->id)) ? 'Update' : 'Add'); ?> Country</h4>
            </div>

            <?php if(isset($data) && !empty($data->id)): ?>
                <?php $id = $data->id; ?>
            <?php else: ?>
                <?php $id = 0;?>
            <?php endif; ?>
            <form class="tablelist-form" method="POST" enctype="multipart/form-data" action="<?php echo e(url($actionURL.'/action',$view).'/'.$id ?? 0); ?>" autocomplete="off" id="countryform">
            <?php echo csrf_field(); ?>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="country_code"
                                    class="form-label">Country Code<span class="error">*</span></label>
                                <input type="text" id="country_code" name="country_code"
                                    class="form-control" placeholder="Enter country code +91"
                                    value="<?php echo e($data->country_code ?? ''); ?>" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="title"
                                    class="form-label">Title<span class="error">*</span></label>
                                <input type="text" id="title" name="title"
                                    class="form-control" placeholder="Enter country name"
                                    value="<?php echo e($data->title ?? ''); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                            <a href="<?php echo e(route('countries')); ?>" class="btn btn-light">Close</a>
                        <button type="submit" class="btn btn-success"
                            id="add-btn"><?php echo e((isset($data) && !empty($data->id)) ? 'Update' : 'Add'); ?> Country</button>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digicampus/public_html/dms.digicampus.app/resources/views/admin/country/create.blade.php ENDPATH**/ ?>