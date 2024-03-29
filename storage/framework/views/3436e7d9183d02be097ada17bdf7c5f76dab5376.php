<?php $__env->startSection('main-content'); ?>
<div class="container">
    <div class="row justify-content-center">

        <div class="col-lg-8">

        <style type="text/css">
              body {
                background-image: linear-gradient(120deg,#2FA2E5,#65D6F4);
            }
          </style>

          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-5">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg">
                  <div class="p-4">
                    <div class="text-center">
                      <img src="<?php echo e(asset('img/cover-login.png')); ?>" alt="logo-image" class="img-circle"><br><br>
                      <h1 class="h4 text-gray-900 mb-0"><b>SISTEM INFORMASI<br>PEMBAYARAN SPP<br>SMK BINA PUTRA</h1>
                      <p class="mb-1"><em class="text-primary">Selamat datang silahkan masuk sebagai</em></p>
                      <!-- <p class="lead text-gray-900 mb-3">SMP ISLAM IBNU KHALDUN BANDA ACEH</p> -->
                      <hr>
                      <h1 class="h4 text-gray-900">Login Admin</h1><br>
                    </div>
                    <form class="user" method="post" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                      <div class="form-group">
                        <input class="form-control" name="email" type="text" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <input class="form-control" name="password" type="password" placeholder="Password">
                      </div>

                      <div class="form-group">
                          <label for="new_password"> <h6>&emsp;</h6></label>
                          <input type="checkbox" class="form-check-input" id="show-password">Tampilkan Password
                      </div>

                      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#show-password').click(function() {
                                    if ($(this).is(':checked')) {
                                        $('#password').attr('type', 'text');
                                    } else {
                                        $('#password').attr('type', 'password');
                                    }
                                });
                            });
                        </script>

                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                      </button>
                    </form><br>
                    <div class="text-center dont-have"><a href="<?php echo e(route('login-siswa')); ?>">Akses Siswa</a></div>
                    <hr>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ristiandhii/Downloads/sistem_spp/resources/views/auth/login.blade.php ENDPATH**/ ?>