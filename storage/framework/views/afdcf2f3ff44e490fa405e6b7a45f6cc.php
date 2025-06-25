

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="my-4">Lost and Found Items</h2>
    
    <!-- Flash Message -->
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Search and Status Filter -->
    <form method="GET" action="<?php echo e(route('items.index')); ?>" class="d-flex mb-4">
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search items..." class="form-control me-2">
        <select name="status" class="form-select me-2">
            <option value="" <?php echo e(request('status') == '' ? 'selected' : ''); ?>>All Statuses</option>
            <option value="lost" <?php echo e(request('status') == 'lost' ? 'selected' : ''); ?>>Lost</option>
            <option value="found" <?php echo e(request('status') == 'found' ? 'selected' : ''); ?>>Found</option>
            <option value="claimed" <?php echo e(request('status') == 'claimed' ? 'selected' : ''); ?>>Claimed</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Items List -->
    <?php if($items->count()): ?>
        <div class="row">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <?php if($item->image): ?>
                            <img src="<?php echo e(asset('storage/' . $item->image)); ?>" class="card-img-top" alt="<?php echo e($item->name); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($item->name); ?></h5>

                            <!-- Status Badge -->
                            <span class="badge 
                                <?php echo e($item->status == 'lost' ? 'bg-danger' : ($item->status == 'found' ? 'bg-warning' : 'bg-success')); ?>">
                                <?php echo e(ucfirst($item->status)); ?>

                            </span>

                            <p class="card-text"><?php echo e(Str::limit($item->description, 100)); ?></p>

                            <!-- Date/Time Info -->
                            <?php if($item->time_lost): ?>
                                <p class="mb-1"><small class="text-muted">Lost: <?php echo e(\Carbon\Carbon::parse($item->time_lost)->format('M d, Y g:i A')); ?></small></p>
                            <?php endif; ?>
                            <?php if($item->time_found): ?>
                                <p><small class="text-muted">Found: <?php echo e(\Carbon\Carbon::parse($item->time_found)->format('M d, Y g:i A')); ?></small></p>
                            <?php endif; ?>

                            <!-- View Details Button -->
                            <a href="<?php echo e(route('items.show', $item)); ?>" class="btn btn-outline-primary btn-sm">View Details</a>

                            <!-- Delete Button -->
                            <form action="<?php echo e(route('items.destroy', $item)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo e($items->withQueryString()->links()); ?>

    <?php else: ?>
        <p>No items found.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\lost-found\resources\views/items/index.blade.php ENDPATH**/ ?>