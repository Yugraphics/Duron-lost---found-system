

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Lost and Found Portal</h1>
        <p class="text-secondary">Helping you recover what matters most.</p>

        <div class="row justify-content-center mt-4">
            <div class="col-md-3 mb-2">
                <a href="<?php echo e(route('items.create')); ?>" class="btn btn-primary w-100">Report Lost Item</a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="<?php echo e(route('items.index')); ?>" class="btn btn-outline-primary w-100">Browse Items</a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="<?php echo e(route('contacts.create')); ?>" class="btn btn-outline-secondary w-100">Contact Us</a>
            </div>

            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->is_admin): ?>
                <div class="col-md-3 mb-2">
                    <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-outline-dark w-100">View Messages</a>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if($recentItems->count()): ?>
    <h4 class="mb-3">Recently Reported Items</h4>
    <div class="row">
        <?php $__currentLoopData = $recentItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <?php if($item->image): ?>
                <img src="<?php echo e(asset('storage/' . $item->image)); ?>" class="card-img-top" alt="<?php echo e($item->name); ?>" style="object-fit: cover; height: 200px;">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($item->name); ?></h5>
                    <p class="card-text"><?php echo e(Str::limit($item->description, 80)); ?></p>
                    <p class="mb-1 text-muted"><small>Status: <?php echo e(ucfirst($item->status)); ?></small></p>
                    <p class="text-muted"><small>Location: <?php echo e($item->location); ?></small></p>
                    <a href="<?php echo e(route('items.show', $item)); ?>" class="btn btn-sm btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php else: ?>
    <div class="alert alert-info text-center">
        No items have been reported recently.
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\lost-found\resources\views/home.blade.php ENDPATH**/ ?>