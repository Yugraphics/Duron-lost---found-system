

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Report Lost or Found Item</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('items.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <div class="mb-3">
            <label for="name" class="form-label">Item Name *</label>
            <input type="text" name="name" class="form-control" id="name" value="<?php echo e(old('name')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description *</label>
            <textarea name="description" class="form-control" id="description" rows="4" required><?php echo e(old('description')); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location (Optional)</label>
            <input type="text" name="location" class="form-control" id="location" value="<?php echo e(old('location')); ?>">
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Contact Info (Optional)</label>
            <input type="text" name="contact" class="form-control" id="contact" value="<?php echo e(old('contact')); ?>">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status *</label>
            <select name="status" id="status" class="form-select" required>
                <option value="" disabled selected>Select status</option>
                <option value="lost" <?php echo e(old('status') == 'lost' ? 'selected' : ''); ?>>Lost</option>
                <option value="found" <?php echo e(old('status') == 'found' ? 'selected' : ''); ?>>Found</option>
                <option value="claimed" <?php echo e(old('status') == 'claimed' ? 'selected' : ''); ?>>Claimed</option>
            </select>
        </div>

        
        <div class="mb-3">
            <label for="time_lost" class="form-label">Date and Time Lost (Optional)</label>
            <input type="datetime-local" name="time_lost" id="time_lost" class="form-control" value="<?php echo e(old('time_lost')); ?>">
        </div>

        
        <div class="mb-3">
            <label for="time_found" class="form-label">Date and Time Found (Optional)</label>
            <input type="datetime-local" name="time_found" id="time_found" class="form-control" value="<?php echo e(old('time_found')); ?>">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Upload Image (Optional)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Report Item</button>
        <a href="<?php echo e(route('items.index')); ?>" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\lost-found\resources\views/items/create.blade.php ENDPATH**/ ?>