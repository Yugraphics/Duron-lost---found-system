<!-- resources/views/items/show.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        <?php if($item->image): ?>
            <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="<?php echo e($item->name); ?>" class="img-fluid mb-3 rounded">
        <?php endif; ?>

        <h3><?php echo e($item->name); ?></h3>
        <p><?php echo e($item->description); ?></p>
        <p><strong>Status:</strong> <?php echo e(ucfirst($item->status)); ?></p>
        <p><strong>Location:</strong> <?php echo e($item->location ?? 'N/A'); ?></p>
        <p><strong>Contact:</strong> <?php echo e($item->contact ?? 'N/A'); ?></p>

        <?php if($item->time_lost): ?>
            <p><strong>Date & Time Lost:</strong> <?php echo e(\Carbon\Carbon::parse($item->time_lost)->format('F j, Y \a\t g:i A')); ?></p>
        <?php endif; ?>

        <?php if($item->time_found): ?>
            <p><strong>Date & Time Found:</strong> <?php echo e(\Carbon\Carbon::parse($item->time_found)->format('F j, Y \a\t g:i A')); ?></p>
        <?php endif; ?>

        <!-- Action Buttons -->
        <a href="<?php echo e(route('items.edit', $item)); ?>" class="btn btn-outline-primary me-2">Edit</a>

        <form action="<?php echo e(route('items.destroy', $item)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-outline-danger">Delete</button>
        </form>

        <a href="<?php echo e(route('items.index')); ?>" class="btn btn-secondary">Back</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\lost-found\resources\views/items/show.blade.php ENDPATH**/ ?>