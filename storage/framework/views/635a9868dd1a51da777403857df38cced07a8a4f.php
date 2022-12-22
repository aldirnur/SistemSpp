<?php $__env->startSection('main-content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('Data User')); ?></h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row">

        

        <div class="container-fluid">

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                    <a href="#add_user" data-toggle="modal" class="btn btn-sm btn-primary shadow-sm" > <i class="fas fa-user-plus fa-sm"></i>Tambah User</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Created date</th>
                                    <th class="text-center action-btn">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <input type="hidden" id="iduser_<?php echo e($key); ?>" value="<?php echo e($user->id); ?>">
                                    <td id="name_<?php echo e($key); ?>">
                                        <?php echo e($user->name); ?>

                                    </td>
                                    <td id="email_<?php echo e($key); ?>">
                                        <?php echo e($user->email); ?>

                                    </td>
                                    
                                    <td id="level_<?php echo e($key); ?>">
                                        <?php echo e($user->level); ?>

                                    </td>
                                    
                                    <td><?php echo e(date_format(date_create($user->created_at),"d M,Y")); ?></td>

                                    <td class="text-center">
                                        <div class="actions">
                                            <a data-id="<?php echo e($user->id); ?>" data-name="<?php echo e($user->name); ?>" data-email="<?php echo e($user->email); ?>" class="btn btn-sm btn-primary shadow-sm editbtn"  data-toggle="modal" href="#edit_user" onclick="editUser(<?php echo e($key); ?>);">
                                                <i class="fe fe-pencil"></i> Edit
                                            </a>
                                            <a data-id="<?php echo e($user->id); ?>" href="javascript:void(0);" class="btn btn-sm btn-danger shadow-sm" data-toggle="modal">
                                                <i class="fe fe-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_user" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="<?php echo e(route('users')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="John Doe">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Level</label>
                                    <div class="form-group">
                                        <select class="select2 form-select form-control edit_role" name="level">
                                            <?php $__currentLoopData = $level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lvl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>"><?php echo e($lvl); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /ADD Modal -->

    <!-- Edit Details Modal -->
    <div class="modal fade" id="edit_user" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="<?php echo e(route('users')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field("PUT"); ?>
                        <div class="row form-row">
                            <input type="hidden" name="id" id="edit_id">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" id="edit_name" class="form-control edit_name" placeholder="John Doe">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control edit_email" id="email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Level</label>
                                    <div class="form-group">
                                        <select class="select2 form-select form-control edit_role" name="level">
                                            <?php $__currentLoopData = $level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lvl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>"><?php echo e($lvl); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
		// $(document).ready(function() {
		// 	$('#datatable-export').on('click','.editbtn',function (){
		// 		event.preventDefault();
		// 		jQuery.noConflict();
		// 		$('#edit_user').modal('show');
		// 		var id = $(this).data('id');
		// 		var name = $(this).data('name');
		// 		var email = $(this).data('email');
		// 		var role = $(this).data('role');
		// 		$('#edit_id').val(id);
		// 		$('.edit_name').val(name);
		// 		$('.edit_email').val(email);
		// 		$('.edit_role').val(role);
		// 	});
		// });
        function editUser(i) {

            console.log(i);
            $('#edit_user').addClass('show');
            var id = $('#iduser_'+i).val();
            console.log(id);
            var name =  document.getElementById("name_"+i).innerText;
            var email =  document.getElementById("email_"+i).innerText;
            var level =  document.getElementById("level_"+i).innerText;
            console.log(level);
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('.edit_email').val(email);
            $('.edit_role').val(level);
        }
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/data_user/user.blade.php ENDPATH**/ ?>