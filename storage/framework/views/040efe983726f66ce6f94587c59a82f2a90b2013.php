<?php $__env->startSection('main-content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('Data Tagihan')); ?></h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Data Tagihan Anda</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class=" table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Nominal Spp</th>
                                    <th>Jumlah Bulan</th>
                                    <th>Jumlah Tagihan</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $tagihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $nomin = isset($item->spp->nominal_spp) ? $item->spp->nominal_spp : 0;
                                    $total = $nomin * $item->jumlah
                                ?>
                                <tr>
                                    <td>
                                        <?php echo e(isset($item->siswa->nama) ? $item->siswa->nama : ''); ?>

                                    </td>
                                    <td><?php echo e(isset($item->spp->nominal_spp) ? $item->spp->nominal_spp : 0); ?></td>
                                    <td><?php echo e($item->jumlah); ?></td>
                                    <td><?php echo e($total); ?></td>
                                    <?php if($item->status == 1): ?>
                                        <td><span class="btn btn-sm bg-success-light">Lunas</span></td>
                                    <?php else: ?>
                                        <td><span class="btn btn-sm bg-danger-light">Belum Lunas</span></td>
                                    <?php endif; ?>

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

<?php echo $__env->make('layouts.app-siswa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/halaman_siswa/tagihan_siswa.blade.php ENDPATH**/ ?>