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

              <div class="col-md-<?php echo $this->session->userdata('level')!=''?'8':'12'?>">
                     <div class="box">
                            <div class="box-header  with-border box-primary">
                                   <h3 class="box-title">Kontak Bimbel</h3>
                            </div>
                            <div class="box-body">
                            <div class="col-md-12">
                                   <h3>Hubungi</h3>
                                   <p> BBM  Pin : <strong>512CD555</strong><br>
Whats up   : <strong>085220903259</strong><br>
Line : <strong>widi_g</strong><br>
Follow ig : <strong>bm_bimbel</strong></p>
                            </div>
                            </div>
                     </div>
              </div>
              <?php if ($this->session->userdata('level')!=''): ?>
              <div class="col-md-4">
                     <?php $this->load->view('template/ajukan_pertanyaan'); ?>
                     <?php $this->load->view('template/profil_widget');?>
              </div>
              <?php endif?>

	</div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>