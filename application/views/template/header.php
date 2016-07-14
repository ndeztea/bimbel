</head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="<?php echo base_url() ?>" class="navbar-brand"><b>BIMBEL </b>online</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url()?>">Home</a></li>
              
            <?php if ($this->session->userdata('level') == "1"): ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Master <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url() ?>pelajaran">Data Pelajaran</a></li>
                    <li><a href="<?php echo base_url() ?>data_pertanyaan">Data Pertanyaan</a></li>
                    <li><a href="<?php echo base_url()?>users">Data User</a></li>
                    <li><a href="<?php echo base_url()?>voucher">Data Voucher Wids</a></li>
                  </ul>
                </li>
            <?php endif ?> 
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Wids <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url() ?>buy_voucher">Pembelian Wids</a></li>
                    <li><a href="#">Penjualan Wids</a></li>
                    <li><a href="#">Reseller Wids</a></li>
                  </ul>
                </li>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            
                <li><a href="<?php echo base_url()?>">Panduan Member</a></li>
              </ul>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <select name="pegawai" id="navbar-search-input" class="form-control pencarian">
                          
                  </select>
                </div>
              </form>
            </div><!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="<?php echo thumb_avatar($this->session->userdata('avatar'),$this->session->userdata('gender'))?>" 
                      alt="User Image" class="user-image image-profile">
                      <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="user-header">
                                    <img src="<?php echo thumb_avatar($this->session->userdata('avatar'),$this->session->userdata('gender'))?>" class="img-circle" alt="User Image" />
                        <p>
                          <?php echo $this->session->userdata('nama'); ?>
                          <small>Member since Nov. 2012</small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <li class="user-body">
                        <div class="col-xs-12 text-center">
                          <a href="#"><?php echo $this->session->userdata('wids'); ?> Wids</a>
                        </div>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="<?php echo base_url() ?>profil" class="btn btn-default btn-flat">Profil</a>
                        </div>
                        <div class="pull-right">
                          <a href="<?php echo base_url() ?>sign_out" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
     <!-- Full Width Column -->
      <div class="content-wrapper">
          <div class="container">