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
              <div class="col-md-8">
                <form method="post" action="<?php echo base_url() ?>edit_jawaban/<?php echo $this->uri->rsegment(3)?>" enctype="multipart/form-data">
                  <div class="box box-bordered table-responsive">
                    <div class="box-header">
                      <h3 class="box-title">Edit Jawaban</h3>
                    </div>
                    <div class="box-body">
                      <img class="img-circle img-sm" src="<?php echo thumb_avatar($this->session->userdata('avatar'),$this->session->userdata('gender'))?>" alt="user image">
                      <div class="img-push">
                        <textarea class="form_control" id="editor2" name="jawaban"> <?php echo $a['jawaban'] ?></textarea>
                        <div class="form-group">
                          <label for="gambar">Ubah Gambar</label>
                          <input type="file" name="gambar">
                        </div>
                      </div>
                    </div>
                    <div class="box-footer">
                      <button class="btn btn-lg btn-primary pull-right" type="submit"><i class="fa fa-paper-plane"></i> Edit</button>
                      <button class="btn btn-lg btn-primary pull-right" onclick=self.history.back()><i class="fa fa-arrow-left"></i> Kembali</button>

                    </div>
                  </div>
              </form>
            </div>
            <div class="col-md-4">
              <?php $this->load->view('template/ajukan_pertanyaan'); ?>
              <?php $this->load->view('template/profil_widget'); ?>
            </div>
  </div>
</section>  
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');

      });
    </script>

<?php $this->load->view('template/foot'); ?>