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
              <?php $a = $edit_jawaban ?>
              <form method="post" action="<?= base_url() ?>edit_jawaban/<?= $this->uri->rsegment(3)?>">
                     <div class="box-footer">
                             <img class="img-circle img-sm" src="<?= base_url('assets/images/avatar/')."/".$this->session->userdata('avatar') ?>" alt="user image">
                            <div class="img-push">
                              <form action="" method="post" accept-charset="utf-8">
                                <div class="input-group">
                                  <div>
                                   <textarea class="form_control" id="editor1" name="jawaban"><?= $a['jawaban'] ?></textarea>
                                   </div>
                                   <div>
                                      <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit" id="submit"><i class="fa fa-paper-plane"></i></button>
                                      </span>
                                    </div>
                                </div><!-- /input-group -->   
                              </form>
                            </div>
                     </div>
              </form>
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