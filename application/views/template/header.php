<?php 

  $pelajaran        = $this->Mpelajaran->getdata()->result();
?>
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
                <li><a href="<?php echo base_url()?>">Beranda</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mata Pelajaran <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <?php foreach ($pelajaran as $r): ?>
                        <li><a href="<?php echo base_url() ?>mapel/<?php echo $r->id ?>"><?php echo $r->pelajaran?></a></li>
                    <?php endforeach ?>
                  </ul>
                </li>
           


                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Wids <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url() ?>buy_voucher">Pembelian Wids</a></li>
                    <li><a href="#">Penjualan Wids</a></li>
                    <li><a href="<?php echo base_url() ?>add_reseller">Daftar Reseller</a></li>
                    <?php if ($this->session->userdata('level') == "3"): ?>
                      <li><a href="<?php echo base_url() ?>my_voucher">Voucher Saya</a></li>
                    <?php endif ?>
                  </ul>
                </li>
              
            <!-- Collect the nav links, forms, and other content for toggling -->
            
                <!--li><a href="<?php echo base_url()?>guide">Panduan Member</a></li>
                <li><a href="<?php echo base_url()?>about">Tentang Bimbel</a></li-->
                 <?php if ($this->session->userdata('level') == "1"): ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Master <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="<?php echo base_url() ?>pelajaran">Data Pelajaran</a></li>
                      <li><a href="<?php echo base_url() ?>data_pertanyaan">Data Pertanyaan</a></li>
                      <li><a href="<?php echo base_url()?>users">Data User</a></li>
                      <li><a href="<?php echo base_url()?>voucher">Data Voucher Wids</a></li>
                      <li><a href="<?php echo base_url()?>data_reseller">Data Reseller</a></li>
                    </ul>
                  </li>
              <?php endif ?> 
              <?php if ($this->session->userdata('level') == "4"): ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lainnya <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="<?php echo base_url() ?>member_below">Data Anggota</a></li>
                    </ul>
                  </li>
              <?php endif ?> 

                

                


              </ul>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <select name="pertanyaan" id="navbar-search-input" class="form-control pencarian">
                          
                  </select>
                </div>
              </form>
            </div>
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                <li class="dropdown user user-menu hidden-sm hidden-xs hidden-md ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <?php echo $this->session->userdata('nama'); ?> <img src="<?php echo thumb_avatar($this->session->userdata('avatar'),$this->session->userdata('gender'))?>" 
                      alt="User Image" class="user-image image-profile">
                    </a>
                </li>
                <li class="dropdown user user-menu">
                  <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"> </i></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url()?>profil" style="color:#000">Profile</a></li>
                      <li><a href="<?php echo base_url() ?>update_profil" style="color:#000">Edit Profile</a></li>
                      <li><a href="<?php echo base_url() ?>update_password" style="color:#000">Ubah Password</a></li>
                      
                    </ul>
                  </li>
                </li>
                <li class="dropdown user user-menu">
                  <li><a href="<?php echo base_url() ?>sign_out"><i class="fa fa-power-off"> </i></a></li>
                </li>
                </ul>
              </div>
          </div>
        </nav>
      </header>
     <!-- Full Width Column -->
      <div class="content-wrapper">
          <div class="container">