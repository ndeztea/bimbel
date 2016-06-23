<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>
<section class="content">
	<div class="row">
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
		<div class="col-md-8">
			<!-- List Pertanyaan -->
			<div class="box box-primary table-responsive">
	          	<div class="box-header with-border">
	          		<h2 class="box-title">Pertanyaan</h2>
	            </div>
	            <div class="box-body box-comments">
	            	<?php foreach ($pertanyaan->result() as $r): ?>
	            		<div class="box-comment"> 
	            			<img class="img-circle img-sm" src="
	            			<?= base_url('assets/images/avatar')."/".$r->avatar_penanya; ?>">
	            			<div class="comment-text">
	            				<span class="username">
	            					<?= $r->nama_pelajaran ?>&middot;
					         	 	<?= $r->wids_pertanyaan ?> Wids &middot;
					         	 	<?= get_tingkat($r->tingkat) ?>
	            				</span>
	            				<a href="<?= base_url() ?>detail_pertanyaan/<?= $r->id_pertanyaan ?>"><?= $r->pertanyaan ?></a>
          						<button class="btn btn-success btn-xs pull-right" onclick=location.href="<?= base_url() ?>detail_pertanyaan/<?= $r->id_pertanyaan ?>"><i class="fa fa-share"></i> Jawab</button>
	            			</div>
					    </div>
			        <?php endforeach; ?>
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
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');

      });
    </script>

<?php $this->load->view('template/foot'); ?>