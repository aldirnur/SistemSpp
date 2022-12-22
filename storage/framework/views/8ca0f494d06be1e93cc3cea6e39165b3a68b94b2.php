<?php $__env->startSection('main-content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('Data Transaksi')); ?></h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Siswa</h6>
                    <a class="btn btn-sm btn-primary shadow-sm" href="<?php echo e(route('add-transaksi')); ?>"><i class="fas fa-user-plus fa-sm"></i> Tambah Transaksi</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center thead-light">
                                <tr>
                                <tr>
                                    <th scope="col" >Nama Siswa</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Bukti Transaksi</th>
                                    <th scope="col">Notes</th>
                                    <th class="action-btn">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tbody>
                                    <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(isset($item->tagihan->siswa) ? $item->tagihan->siswa->nama : '-'); ?></td>
                                            
                                            <?php if($item->status_transaksi == 1): ?>
                                                <td><span class="btn-sm bg-success-light">Diterima</span></td>
                                            <?php elseif($item->status_transaksi == 2): ?>
                                                <td><span class="btn-sm bg-warning-light">Verifikasi</span></td>
                                            <?php else: ?>
                                                <td><span class="btn-sm bg-danger-light">Ditolak</span></td>
                                            <?php endif; ?>

                                            <td><?php echo e($item->no_transaksi); ?></td>
                                            <td><?php echo e($item->tgl); ?></td>
                                            <td><?php echo e($item->nominal_transaksi); ?></td>
                                            <td><a href="#generate_report" data-toggle="modal" onclick="getBukti('<?php echo e($item->bukti_transaksi); ?>');"><?php echo e($item->bukti_transaksi); ?></a></td>
                                            <td>
                                                <?php echo e($item->keterangan); ?>

                                            </td>
                                            <td>
                                                <div class="actions">
                                                    <a class="btn btn-success" href="<?php echo e(route('edit-transaksi',$item->trans_id)); ?>">
                                                        <i class="fe fe-pencil"></i> Edit
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/data_keuangan/transaksi.blade.php ENDPATH**/ ?>