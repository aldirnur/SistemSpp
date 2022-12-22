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
    

    <!-- card -->
    <div class="card shadow mb-4 py-4 px-4">

        <!-- form Input data -->

        <form method="post" enctype="multipart/form-data" id="update_service" action="<?php echo e(route('add-transaksi')); ?>">
            <h3 class="page-title">Form Transaksi</h3>
            <?php echo csrf_field(); ?>

            <div class="service-fields mb-3">
                <div class="row">

                </div>
            </div>

            <div class="service-fields mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Nis & Nama Siswa <span class="text-danger">*</span></label>
                            <select class="select2 form-select form-control" name="siswa" id="siswa">
                                <option value="0">-</option>
                                <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sis->id_siswa); ?>"><?php echo e($sis->nis); ?> - <?php echo e($sis->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
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
                            <label>Tanggal Transaksi<span class="text-danger">*</span></label>
                            <input class="form-control" type="date" id = "date" name="date" value="1"  onchange="getTagihan()"> <i class="fe fe-image"></i>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Bulan<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id = "jumlah" name="Bulan" value="1"  onchange="getTagihan()"> <i class="fe fe-image"></i>
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

            <div class="service-fields mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Keterangan <span class="text-danger">*</span></label>
                            <textarea class="form-control service-desc" name="keterangan"></textarea>
                        </div>
                    </div>

                </div>
            </div>


            <div class="submit-section">
                <button onclick="preLoad();" class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Submit</button>
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
        $(".body").keyup(function(){
            var tunggakan = parseInt($("#tunggakan").val())
            var jumlah_bayar = parseInt($("#jumlah_bayar").val())

            var sisa = tunggakan - jumlah_bayar;
        $("#sisa").attr("value",sisa)
        });
        function getBukti(val) {
        console.log(val);
        var bukti ='<img src="/img/payment/'+val+'" alt="" width="400" height="500">'
            $('#bukti').append(bukti);
            console.log(bukti);
    }

    function getTagihan() {
        id =  $("#siswa").val();
        jumlah =  $("#jumlah").val();

        console.log(id);
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
                        Snackbar.show({
                        text: "Maaf, Jumlah Bulan Yang Anda Masukan Lebih,  Sisa Tagihan Anda Sebanyak " +data.nom + " Bulan",
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/data_keuangan/tambah_transaksi.blade.php ENDPATH**/ ?>