<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
              <?php echo validation_errors(); ?>
			<?php
              if($this->session->flashdata('msg_error') != NULL){
              echo '<div class="alert alert-danger" role="alert" style="padding: 6px 12px;height:34px;">';
              echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg_error')."</span></strong>";
              echo '</div>';
              }?>
              <?php
              if($this->session->flashdata('msg_success') != NULL){
              echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
              echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg_success')."</span></strong>";
              echo '</div>';
              }?>
		</div>

              <div class="col-md-8">
                     <div class="box">
                            <form method="post" action="<?php echo base_url() ?>update_password">
                            <div class="box-header box-primary with-border">
                                   <h3 class="box-title">Ubah Password</h3>
                            </div>
                            <div class="box-body">
                                   <div class="form-group">
                                          <label>Password Lama</label>
                                          <input type="password" name="password" class="form-control">
                                   </div>
                                   <div class="form-group">
                                          <label>Password Baru</label>
                                          <input type="password" name="new_password" class="form-control">
                                   </div>
                                   <div class="form-group">
                                          <label>Konfirmasi Password Baru</label>
                                          <input type="password" name="confirm_password" class="form-control">
                                   </div>
                            </div>
                            <div class="box-footer">
                                   <button type="submit" class="btn btn-info pull-right">Ubah Password</button>

                                   <button type="button" class="btn btn-danger pull-right">Kembali</button>
                            </div>
                     </div>
              </div>


      <div class="col-md-4">
        <?php $this->load->view('template/profil_widget');?>
        <?php $this->load->view('template/ajukan_pertanyaan'); ?>
    </div>

	</div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>