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

		<!-- Custom Content Here -->
              <?php $a = $pertanyaan_saya ?>
              <form method="post" action="<?= base_url() ?>edit_pelajaran/<?= $a['id'] ?>">
              <div class="box box-primary table-responsive">
                     <div class="box-header">
                            <h3 class="box-title">Tambah Data</h3>
                     </div>
                     <div class="box-body">
                            <div class="form-group">
                                   <label>Nama Mata Pelajaran :</label>
                                   <input type="text" name="mata_pelajaran" class="form-control" value="<?= $a['pelajaran'] ?>">
                            </div>
                            <div class="form-group">
                                   <label>Deskripsi :</label>
                                   <textarea class="form-control" name="deskripsi"><?= $a['deskripsi'] ?></textarea>
                            </div>
                            <div class="form-group">
                                   <label>Icon :</label>
                                   <input type="text" name="icon" class="form-control" value="<?= $a['params'] ?>">
                            </div>
                     </div>
                     <div class="box-footer">
                            <button  type="submit" class="btn btn-primary">Edit Data</button>
                     </div>
              </div>
              </form>
	</div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>