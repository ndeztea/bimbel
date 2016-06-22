<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>
<section class="content">
	<div class="row">
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
	            			<?php
                                      if($r->avatar_penanya == NULL):
                                        echo base_url()."assets/images/avatar/default.jpg";
                                      else:
                                        echo base_url()."assets/images/avatar/".$r->avatar_penanya;
                                      endif;?>
	            			" alt="user image">
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
<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>

<?php $this->load->view('template/foot'); ?>