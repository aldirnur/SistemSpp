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
                    

                    <div class="col-sm-12 col">
                    <a class="btn btn-sm btn-primary shadow-sm"  href="#generate_report" data-toggle="modal"><i class="fas fa-plus fa-sm"></i> Import Tagihan</a>
                    <a class="btn btn-sm btn-primary shadow-sm"  href="#add-tagihan" data-toggle="modal"><i class="fas fa-plus fa-sm"></i>  Tambah Tagihan</a>
                    <a class="btn btn-sm btn-primary shadow-sm"  onclick="location.reload()" href="#" data-toggle="modal"><i class="fas fa-fw fa-comments"></i>  Send Notfikasi Tagihan</a>
                    </div>
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
                                    <th class="action-btn">Action</th>
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
                                    <td>
                                        <div class="actions">
                                            <a class="btn btn-sm btn-primary shadow-sm" href="<?php echo e(route('edit-tagihan',$item->tag_id)); ?>">
                                                <i class="fe fe-pencil"></i> Edit
                                            </a>
                                            <a onclick="preLoad();" class="btn btn-sm btn-danger shadow-sm" href="/delete-tagihan/<?php echo e($item->tag_id); ?>">
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
    <div class="modal fade" id="generate_report" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(route('import-excel-tagihan')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row form-row">
                            <div class="col-12">
                                <input type="file" name="file" required="required">
                                <a href="<?php echo e(route('export-excel-tagihan')); ?>" class="btn btn-primary float-left mt-2">Download Format Tagihan Siswa</a>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-tagihan" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(route('add-tagihan')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Siswa <span class="text-danger">*</span></label>
                                    <select class="select2 form-select form-control" name="siswa">
                                        <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sw->id_siswa); ?>"><?php echo e($sw->nis); ?> - <?php echo e($sw->nama); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>SPP <span class="text-danger">*</span></label>
                                    <select class="select2 form-select form-control" name="spp">
                                        <?php $__currentLoopData = $spp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sp->id_spp); ?>">Rp. <?php echo e($sp->nominal_spp); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label>Jumlah <span class="text-danger">*</span></label><br>
                                <input type="number" name="jumlah" required="required">
                            </div>
                        </div>
                        <br>
                        <button  onclick="preLoad();" type="submit" class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/data_keuangan/tagihan.blade.php ENDPATH**/ ?>