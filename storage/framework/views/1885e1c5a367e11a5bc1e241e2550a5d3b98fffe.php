<?php $__env->startSection('main-content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('Data Siswa')); ?></h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                    <a class="btn btn-sm btn-primary shadow-sm" href="<?php echo e(route('add-siswa')); ?>"><i class="fas fa-plus fa-sm"></i> Tambah Siswa</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Nis</th>
                                    <th>Nisn</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal lahir</th>
                                    <th>Alamat</th>
                                    <th>No Telfon</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Nama Wali</th>
                                    <th>Agama</th>
                                    <th>Pin</th>
                                    <th class="action-btn">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($item->nis); ?>

                                    </td>
                                    <td><?php echo e($item->nisn); ?></td>
                                    <td><?php echo e($item->nama); ?></td>
                                    <td><?php echo e($item->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan'); ?></td>
                                    <td><?php echo e($item->tgl_lahir); ?></td>
                                    <td><?php echo e($item->alamat); ?></td>
                                    <td><?php echo e($item->no_tlp); ?></td>
                                    <td><?php echo e($item->kelas); ?></td>
                                    <td><?php echo e(isset($item->jurusan->nama_jurusan) ? $item->jurusan->nama_jurusan : ''); ?></td>
                                    <td><?php echo e($item->nama_wali); ?></td>
                                    <td><?php echo e($item->agama); ?></td>
                                    <td><?php echo e($item->pin); ?></td>
                                    <td>
                                        <div class="actions">
                                            <a onclick="preLoad();" class="btn btn-sm bg-success-light" href="<?php echo e(route('edit-siswa',$item->id_siswa)); ?>">
                                                <i class="fe fe-pencil"></i> Edit
                                            </a>

                                            <a onclick="preLoad();" class="btn btn-sm bg-danger-light" href="/delete-siswa/<?php echo e($item->id_siswa); ?>">
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/data_sekolah/data_siswa.blade.php ENDPATH**/ ?>