

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">To-Do List</h1>

    <!-- Task Creation Form -->
    <form action="<?php echo e(route('tasks.store')); ?>" method="POST" class="mb-4">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="New Task" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Add Task</button>
    </form>

    <!-- List of Tasks -->
    <h2>My Tasks</h2>
    <ul class="list-group">
        <?php if($tasks->isEmpty()): ?>
            <li class="list-group-item">No tasks available. Add a new task!</li>
        <?php else: ?>
            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <form action="<?php echo e(route('tasks.toggleCompletion', $task)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?> <!-- Use PATCH here -->
                        <button type="submit" class="btn <?php echo e($task->completed ? 'btn-success' : 'btn-warning'); ?>">
                            <?php echo e($task->completed ? 'Completed' : 'Incomplete'); ?>

                        </button>
                    </form>

                    <span class="flex-grow-1 mx-3"><?php echo e($task->name); ?></span>

                    <div>
                        <a href="<?php echo e(route('tasks.edit', $task)); ?>" class="btn btn-secondary">Edit</a>
                        
                        <form action="<?php echo e(route('tasks.destroy', $task)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\todolist2\resources\views/tasks/index.blade.php ENDPATH**/ ?>