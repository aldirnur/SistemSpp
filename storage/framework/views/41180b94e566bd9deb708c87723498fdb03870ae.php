<?php $__env->startSection('main-content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('Data Report')); ?></h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran Siswa</h6>
                    <a class="btn btn-sm btn-primary shadow-sm" href="#generate_report" data-toggle="modal"><i class="fas fa-book fa-sm"></i> Filter Laporan</a>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo</div>
                            

                            <h3 class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo e(number_format($saldo,2, ',', '.')); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
                <?php if(isset($uang_masuk)): ?>
                    <!--  Sales -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="report-export" class="table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Pembayaran</th>
                                            
                                            <th>Uang Masuk</th>
                                            <th>Nama Siswa</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $saldo = 0;
                                        ?>
                                        <?php $__currentLoopData = $uang_masuk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php
                                                $saldo += $item->nominal_kas;
                                                // if($item->kategori->type == 2) $saldo -= $item->uang_keluar;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($item->tgl); ?>

                                                </td>
                                                
                                                <td><?php echo e($item->nominal_kas); ?></td>
                                                <td><?php echo e(isset($item->transaksi->tagihan->siswa) ? $item->transaksi->tagihan->siswa->nama : '-'); ?></td>
                                                <td><?php echo e($item->notes); ?></td>
                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
        </div>

    </div>

<div class="modal fade" id="generate_report" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo e(route('reports')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row form-row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>From</label>
                                        <input type="date" name="from_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>To</label>
                                        <input type="date" name="to_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Resource</label>
                                <select class="form-control select" name="resource">
                                    <option value="pemasukan">Pemasukan</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <button onclick="preLoad();" type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/data_report/report.blade.php ENDPATH**/ ?>