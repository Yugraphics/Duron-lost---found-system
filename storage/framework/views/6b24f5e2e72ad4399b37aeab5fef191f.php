<!-- resources/views/contacts/create.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        <h3>Contact Us</h3>
        <form action="<?php echo e(route('contacts.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
            </div>
            <button class="btn btn-primary">Send Message</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\lost-found\resources\views/contacts/create.blade.php ENDPATH**/ ?>