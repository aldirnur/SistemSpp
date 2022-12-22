<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/sb-admin-2.min.css')); ?>" rel="stylesheet">

    <!-- Favicon -->
    <link href="<?php echo e(asset('img/favicon.png')); ?>" rel="icon" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/snackbar/snackbar.min.css')); ?>">
    <script src="<?php echo e(asset('plugins/snackbar/snackbar.min.js')); ?>"></script>


    <link rel="stylesheet" href="<?php echo e(asset('plugins/DataTables/datatables.css')); ?>">

</head>
<body id="page-top">


<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PEMBAYARAN SPP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <form action="">
        <input type="hidden" name="">
    </form>

        <!-- Nav Item - Charts -->
        

        <li class="nav-item">
            <a class="nav-link btn-logout" href="/pembayaran?nisn=<?php echo e($siswa->nisn); ?>&pin=<?php echo e($siswa->pin); ?>">
                <i class="fas fa-fw fa-wallet"></i>
                <span>Pembayaran SPP</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link btn-logout" href="<?php echo e(route('tagihan-siswa', $siswa->id_siswa)); ?>">
                <i class="fas fa-fw fa-credit-card"></i>
                <span>Data Tagihan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link btn-logout" href="<?php echo e(route('history',$siswa->id_siswa)); ?>">
                <i class="fas fa-fw fa-history"></i>
                <span>History</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
</ul>
<!-- End of Sidebar
     End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <img src="<?php echo e(asset('/img/binputsmall.png')); ?>" alt="logo-image" class="img-circle">
                <h4 class="lead text-gray-800 d-none d-lg-block ml-3 mt-2">Sistem Informasi Pengelolaan SPP SMK BINA PUTRA </h4>

                <!-- Topbar Search -->
                

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    

                    <!-- Nav Item - Alerts -->
                    

                    <!-- Nav Item - Messages -->

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="">
                                <img src="<?php echo e(asset('/img/user.png')); ?>" alt="logo-image" class="img-circle">
                            </figure>

                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?php echo e(route('profile')); ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                <?php echo e(__('Profile')); ?>

                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                <?php echo e(__('Settings')); ?>

                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                <?php echo e(__('Activity Log')); ?>

                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo e(route('login-siswa')); ?>" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                <?php echo e(__('Logout')); ?>

                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <?php echo $__env->yieldContent('main-content'); ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">

            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>&copy; SMK Bina Putra</span>
                </div>
            </div>

        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Apakah Yakin Keluar?')); ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik Logout Jika Ingin Keluar.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                <a class="btn btn-danger" href="<?php echo e(route('login-siswa')); ?>"><?php echo e(__('Logout')); ?></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="generate_token" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align: center">Silahkan Masukan Kode OTP</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo e(route('add-token')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row form-row">
                        <div class="col-12">
                            <?php if(Session::has('message')): ?>
                                <em class="text-danger">Pastikan OTP Yang Anda Masukan Benar.</em>
                            <?php endif; ?>
                            <div class="form-group">
                                <br>
                                <label style="font-weight: 10px">OTP<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="token">
                            </div>
                        </div>
                    </div>
                    <button onclick="preLoad();" type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/sb-admin-2.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/datatables-customizer.js')); ?>"></script>
<script>
    $(document).ready(function() {

    });
    <?php if(Session::has('message')): ?>
        var type = "<?php echo e(Session::get('alert-type', 'info')); ?>";
        switch(type){
            case 'info':
                Snackbar.show({
                    text: "<?php echo e(Session::get('message')); ?>",
                    actionTextColor: '#fff',
                    backgroundColor: '#2196f3'
                });
                break;

            case 'warning':
                Snackbar.show({
                    text: "<?php echo e(Session::get('message')); ?>",
                    pos: 'top-right',
                    actionTextColor: '#fff',
                    backgroundColor: '#e2a03f'
                });
                break;

            case 'success':
                Snackbar.show({
                    text: "<?php echo e(Session::get('message')); ?>",
                    pos: 'top-right',
                    actionTextColor: '#fff',
                    backgroundColor: '#8dbf42'
                });
                break;

            case 'danger':
                Snackbar.show({
                    text: "<?php echo e(Session::get('message')); ?>",
                    pos: 'top-right',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a'
                });
                break;
            case 'popup':
                $('#generate_token').addClass('show').css('display', 'block'),
                $('#wrapper').css('filter', 'blur(8px)')
            break;
        }
    <?php endif; ?>
</script>
<script src="<?php echo e(asset('plugins/DataTables/datatables.min.js')); ?>"></script>

</body>
</html>
<?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/layouts/app-siswa.blade.php ENDPATH**/ ?>