<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kegiatan | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/AdminLTE.min.css">

  <style>
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-container {
      text-align: center;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

  </style>

</head>
<body style="background-image: url(<?=base_url('asset/dist/img/background.jpeg')?>); background-size: cover; background-position: center;">

  <div class="login-container">
    <!-- Buku Tamu title -->
    <h2><i class="fa fa-book"></i> Buku Tamu <br> RPTRA Jakarta Timur</h2>
    <h4>Login Admin</h4>

    <!-- Login Form -->
    <div class="login-box">
      <div class="login-box-body">
        <p class="login-box-msg">
          <img src="<?=base_url('asset/dist/img/user.png')?>" class="img img-responsive img-circle" style="margin: 0 auto;" width="80px" height="80px">
        </p>
        <form action="<?php echo base_url('Login/aksi_login'); ?>" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo base_url(); ?>asset/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
