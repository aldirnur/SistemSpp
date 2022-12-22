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
        <form method="post" enctype="multipart/form-data" id="update_service" action="<?php echo e(route('edit-transaksi', $transaksi->trans_id)); ?>">
            <H2>Edit Transaksi</H2>
            <?php echo csrf_field(); ?>

            <div class="service-fields mb-3">
                <div class="row">

                </div>
            </div>

            <div class="service-fields mb-3">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select class="select2 form-select form-control" onchange="getStatus(this.value)" id="status" name="status">
                                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e($key == $transaksi->status_transaksi ? 'selected' : ''); ?>><?php echo e($sts); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Nominal<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nominal" value="<?php echo e($transaksi->nominal_transaksi); ?>">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Tanggal<span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="date" value="<?php echo e($transaksi->tgl); ?>"> <i class="fe fe-image"></i>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Bukti Pembayaran </label> <br>
                            <a href="#generate_report"  data-toggle="modal"><?php echo e($transaksi->bukti_transaksi); ?></a>
                            
                        </div>
                    </div>
                    <div class="col-lg-12" style="display: none" id="user_note">
                        <div class="form-group">
                            <label>Keterangan Ditolak<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="user_note" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-fields mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Keterangan <span class="text-danger">*</span></label>
                            <textarea class="form-control service-desc" name="keterangan"><?php echo e($transaksi->keterangan); ?></textarea>
                        </div>
                    </div>

                </div>
            </div>


            <div class="submit-section">
                <button onclick="preLoad()" class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Submit</button>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/data_keuangan/edit_transaksi.blade.php ENDPATH**/ ?>