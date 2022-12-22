<?php $__env->startSection('main-content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><?php echo e(__('Login')); ?></h1>
                                </div>

                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger border-left-danger" role="alert">
                                        <ul class="pl-4 my-2">
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="" class="user">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="<?php echo e(__('E-Mail Address')); ?>" value="<?php echo e(old('email')); ?>" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="<?php echo e(__('Password')); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <?php echo e(__('Login')); ?>

                                        </button>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-github btn-user btn-block">
                                            <i class="fab fa-github fa-fw"></i> <?php echo e(__('Login with GitHub')); ?>

                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-twitter btn-user btn-block">
                                            <i class="fab fa-twitter fa-fw"></i> <?php echo e(__('Login with Twitter')); ?>

                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> <?php echo e(__('Login with Facebook')); ?>

                                        </button>
                                    </div>
                                </form>

                                <hr>

                                <?php if(Route::has('password.request')): ?>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo e(route('password.request')); ?>">
                                            <?php echo e(__('Forgot Password?')); ?>

                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if(Route::has('register')): ?>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo e(route('register')); ?>"><?php echo e(__('Create an Account!')); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/auth/login.blade.php ENDPATH**/ ?>