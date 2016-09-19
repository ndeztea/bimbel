</head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
    <?php if($this->session->userdata('id')!=''):?>
      <?php $pelajaran        = $this->Mpelajaran->getdata()->result();?>
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
                    <li><a href="<?php echo base_url() ?>sell_wids">Penukaran Wids</a></li>
                    <li><a href="<?php echo base_url() ?>add_reseller">Menjadi Reseller</a></li>
                    <li><a href="<?php echo base_url() ?>list_reseller">Daftar Reseller</a></li>
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
                      <li><a href="<?php echo base_url()?>data_sell_wids">Data Penukaran Wids</a></li>
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
    <?php else:?>
      <!-- Top menu -->
    <nav class="navbar navbar-inverse navbar-no-bg"  style="background-color: #408DBC;margin-bottom:0px;border:0px" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url() ?>" style="color:#FFFFFF"><b>BIMBEL</b>  Online</a>
        </div>
        <!-- <div class="collapse navbar-collapse" id="top-navbar-1">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <span class="li-text">
                Put some text or
              </span> 
              <a href="#"><strong>links</strong></a> 
              <span class="li-text">
                here, or some icons: 
              </span> 
              <span class="li-social">
                <a href="#"><i class="fa fa-facebook"></i></a> 
                <a href="#"><i class="fa fa-twitter"></i></a> 
                <a href="#"><i class="fa fa-envelope"></i></a> 
                <a href="#"><i class="fa fa-skype"></i></a>
              </span>
            </li>
          </ul>
        </div> -->
                <form method="post" action="<?php echo base_url() ?>login" class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="NISN / Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default">Masuk !</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Lupa Password !!</button>

                </form>
      </div>
    </nav>

    <?php endif?>
     <!-- Full Width Column -->
      <div class="content-wrapper">
          <div class="container">