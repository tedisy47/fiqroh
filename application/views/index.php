<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>YukZakat<?= ($title) ? ' | '.$title : ''; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!--<link rel="stylesheet" href="<?=base_url()?>assets/css/adminlte.min.css"> --> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
</head>
<body>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light text-center fixed-top" style="background: white; box-shadow: 0px 10px 10px 0px #aaa !important;">
    <a class="navbar-brand" href="<?=site_url('/')?>"><h2 class="my-auto font-weight-bold">Yuk<span style="color: #28a745;">Zakat</span></h2></a>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <?php if (!$this->session->userdata('login_id')): ?>          
        <a class="btn btn-success" href="<?=site_url('welcome')?>"><i class="fas fa-sign-in-alt"></i> Login</a>
      <?php else: ?>        
        <a class="btn btn-warning" href="<?=site_url('welcome/logout')?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
      <?php endif ?>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
 <?php $this->load->view($page)?>

  <!-- Main Footer -->
  <!-- <footer class="footer nav-footer pt-2 pb-2 mt-10">
    <div class="row">
    <button type="button" class="btn btn-warning float-left ml-2" onclick="history.back();"><i class="fa fa-arrow-left"></i>Back</button>
    </div>
  </footer> -->
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<!-- Bootstrap -->
<?=$this->session->flashdata('sweatalert')?>
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
</body>
</html>
