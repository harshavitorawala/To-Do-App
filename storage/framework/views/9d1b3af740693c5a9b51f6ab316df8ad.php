

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Task</h1>

    <form action="<?php echo e(route('tasks.update', $task)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <input type="text" name="name" class="form-control" value="<?php echo e($task->name); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Edit Task</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\todolist2\resources\views/tasks/edit.blade.php ENDPATH**/ ?>