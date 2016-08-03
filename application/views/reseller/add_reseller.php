<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
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
                            <form method="post" action="<?php echo base_url()?>add_reseller">
                            <div class="box-header">
                                   <h3 class="box-title">Reseller</h3>
                            </div>
                            <div class="box-body">
                                   <div class="form-group">
                                          <label>Nama</label>
                                          <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama') ?>">
                                   </div>
                                   <div class="form-group">
                                          <label>Alamat</label>
                                          <textarea class="form-control" name="alamat"><?php echo set_value('alamat') ?></textarea>
                                   </div>
                                   <div class="form-group">
                                          <label>No Hp</label>
                                          <input type="text" name="no_hp" class="form-control" value="<?php echo set_value('no_hp') ?>">
                                   </div>
                            </div>
                            <div class="box-footer">
                                   <button class="btn btn-info pull-right" type="submit">Daftar</button>
                                   <button class="btn btn-default pull-right" type="button" onclick=self.history.back();>Kembali</button>
                            </div>
                            </form>
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