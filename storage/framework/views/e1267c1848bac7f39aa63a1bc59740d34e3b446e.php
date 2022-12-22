<?php $__env->startSection('main-content'); ?>
    <!-- Page Heading -->
    

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

        

        <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-primary">Form Pembayaran SPP</h1>

    <!-- card -->
    <div class="card shadow mb-4 py-4 px-4">

        <form method="post" enctype="multipart/form-data" id="update_service" action="/pembayaran/<?php echo e($siswa->id_siswa); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id_siswa" id="id_siswa" value="<?php echo e($siswa->id_siswa); ?>">
            <div class="service-fields mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Nama</label>

                            <input class="form-control" type="text" id="nis" name="nama" value="<?php echo e($siswa->nama); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>NISN</label>
                            <input class="form-control" type="number" id="nis" name="nisn" value="<?php echo e($siswa->nisn); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>NIS</label>
                            <input class="form-control" type="number" id="nis" name="nis" value="<?php echo e($siswa->nis); ?>" readonly>
                        </div>
                    </div>



                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Nominal Tagihan<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="nominal" name="nominal" value="0" readonly>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Bulan<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id = "jumlah" name="Bulan" value="0"  onchange="getTagihan()"> <i class="fe fe-image"></i>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Bukti Pembayaran<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="file" value="0"> <i class="fe fe-image"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-danger submit-btn" type="submit" name="form_submit" id="btn_submit" value="submit" disabled>Bayar</button>
            </div>
        </form>
    </div>
</div>

        <!-- akhir form input -->

    </div>
    <!-- /.card -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">

function getTagihan() {
    id =  $("#id_siswa").val();
    jumlah =  $("#jumlah").val();

console.log(id);
    event.preventDefault();
    if (jumlah > 0) {
        $('#btn_submit').removeClass('btn btn-danger submit-btn');
        $('#btn_submit').addClass('btn btn-primary submit-btn');
        $('#btn_submit').prop("disabled", false);
    }

    if (jumlah < 0) {
        $('#btn_submit').removeClass('btn btn-primary submit-btn');
        $('#btn_submit').addClass('btn btn-danger submit-btn');
        $('#btn_submit').prop("disabled", true);
    }


    console.log('<?php echo e(csrf_token()); ?>');
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                }
            });
        $.ajax({
            url: '/get_tagihan',
            type: 'get',
            dataType: 'JSON',
            data: {
                id:id,
                jumlah:jumlah
            },
            success: function(data){
                if (data.status == 'success') {
                    $("#nominal").val(data.nom);
                } else {
                    console.log('test');
                    Snackbar.show({
                    text: data.message,
                    pos: 'top-right',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                });
                    $("#jumlah").val(data.nom);

                }
            }
        });
    }

</script>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-siswa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/halaman_siswa/pembayaran.blade.php ENDPATH**/ ?>