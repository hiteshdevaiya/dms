<?php $__env->startSection('title'); ?> Countries <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0"><?php echo e((isset($data) && !empty($data->id)) ? 'Update' : 'Add'); ?> Category</h4>
            </div>

            <?php if(isset($data) && !empty($data->id)): ?>
                <?php $id = $data->id; ?>
            <?php else: ?>
                <?php $id = 0;?>
            <?php endif; ?>
            <form class="tablelist-form" method="POST" enctype="multipart/form-data" action="<?php echo e(url($actionURL.'/action',$view).'/'.$id ?? 0); ?>" autocomplete="off" id="categoryform">
            <?php echo csrf_field(); ?>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="name"
                                    class="form-label">Name<span class="error">*</span></label>
                                <input type="text" id="name" name="name"
                                    class="form-control" placeholder="Enter category name"
                                    value="<?php echo e($data->name ?? ''); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                            <a href="<?php echo e(route('countries')); ?>" class="btn btn-light">Close</a>
                        <button type="submit" class="btn btn-success"
                            id="add-btn"><?php echo e((isset($data) && !empty($data->id)) ? 'Update' : 'Add'); ?> Category</button>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dms\resources\views/admin/category/create.blade.php ENDPATH**/ ?>