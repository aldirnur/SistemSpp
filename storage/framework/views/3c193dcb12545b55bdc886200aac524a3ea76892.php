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

        <form method="post" enctype="multipart/form-data" action="<?php echo e(route('edit-siswa',$siswa)); ?>">
            <?php echo csrf_field(); ?>
            <div class="service-fields mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Nis<span class="text-danger">*</span></label>
                            <input class="form-control" value="<?php echo e($siswa->nis); ?>" type="text" name="nis" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label>Nisn<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?php echo e($siswa->nisn); ?>" type="text"  name="nisn" readonly>
                    </div>
                </div>
            </div>

            <div class="service-fields mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Nama<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="<?php echo e($siswa->nama); ?>"  name="nama">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_kelamin">
                                <option value="1" <?php echo e($siswa->jenis_kelamin == 1 ? 'selected' : ''); ?>>Laki Laki </option>
                                <option value="2" <?php echo e($siswa->jenis_kelamin == 2 ? 'selected' : ''); ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-fields mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>No Telfon <span class="text-danger">*</span></label>
                            <input type="number" name="no_tlp" value="<?php echo e($siswa->no_tlp); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl" value="<?php echo e($siswa->tgl_lahir); ?>" class="form-control">
                    </div>
                </div>
            </div>

            <div class="service-fields mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Agama <span class="text-danger">*</span></label>
                            <select class="form-control" name="agama">
                                <option value="Islam" <?php echo e($siswa->agama == 'Islam' ? 'selected' : ''); ?>>Islam </option>
                                <option value="Kristen" <?php echo e($siswa->agama == 'Kristen' ? 'selected' : ''); ?> >Kristen</option>
                                <option value="Protestan" <?php echo e($siswa->agama == 'Protestan' ? 'selected' : ''); ?> >Protestan</option>
                                <option value="Hindhu" <?php echo e($siswa->agama == 'Hindhu' ? 'selected' : ''); ?> >Hindhu</option>
                                <option value="Budha" <?php echo e($siswa->agama == 'Budha' ? 'selected' : ''); ?> >Budha</option>
                                <option value="Lainnya" <?php echo e($siswa->agama == 'Lainnya' ? 'selected' : ''); ?> >Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label>Wali</label>
                        <input type="text" name="nama_wali" value="<?php echo e($siswa->nama_wali); ?>" class="form-control">
                    </div>
                </div>
            </div>

            <div class="service-fields mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Kelas <span class="text-danger">*</span></label>
                            <select class="form-control" name="kelas">
                                <option value="X" <?php echo e($siswa->kelas == 'X' ? 'selected' : ''); ?>>X</option>
                                <option value="XI" <?php echo e($siswa->kelas == 'XI' ? 'selected' : ''); ?>>XI</option>
                                <option value="XII" <?php echo e($siswa->kelas == 'XII' ? 'selected' : ''); ?> >XII</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Jurusan <span class="text-danger">*</span></label>
                            <select class="select2 form-select form-control" name="jurusan">
                                <option value="0">-</option>
                                <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jrs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jrs->jur_id); ?>" <?php echo e($siswa->jur_id == $jrs->jur_id ? 'selected' : ''); ?>><?php echo e($jrs->nama_jurusan); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label>Pin</label>
                        <input type="text" maxlength="6" name="pin" value="<?php echo e($siswa->pin); ?>" placeholder="123456" class="form-control">
                    </div>
                </div>
            </div>

            <div class="service-fields mb-3">
                <div class="row">
                    <div class="col-12">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" value="" cols="30" rows="10"><?php echo e($siswa->alamat); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="submit-section">
                <button onclick="preLoad();" class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Submit</button>
                <a href="<?php echo e(route('siswa')); ?>" class="btn btn-primary submit-btn">Batal</a>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/data_sekolah/edit_siswa.blade.php ENDPATH**/ ?>