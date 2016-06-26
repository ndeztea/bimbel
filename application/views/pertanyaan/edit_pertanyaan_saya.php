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
              <?= validation_errors() ?>
              <form method="post" action="<?= base_url() ?>edit_pertanyaan_saya/<?= $this->uri->rsegment(3)?>" enctype="multipart/form-data">
                 <textarea id="editor1" name="pertanyaan" rows="10" cols="80" placeholder="Tulis pertanyaanmu disini"><?= $a['pertanyaan'] ?>
                 </textarea><br>
                 <div class="col-md-3">
                    <div class="form-group">
                           <label>Tingkatan : </label>
                                 <select name="tingkat" class="form-control">
                                  <option  <?php if($a['tingkat']=="SD"):
                                              echo "selected";
                                              endif;?>>
                                  SD
                                  </option>
                                  <option <?php if($a['tingkat']=="SMP"):
                                              echo "selected";
                                              endif; ?>>
                                  SMP
                                  </option>
                                  <option <?php if($a['tingkat']=="SMA"):
                                              echo "selected";
                                              endif; ?>>
                                  SMA
                                  </option>
                                  <option <?php if($a['tingkat']=="SMK"):
                                              echo "selected"; 
                                              endif;?>>
                                  SMK
                                  </option>
                                 </select>
                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="form-group">
                            <label>Mata Pelajaran : </label>
                                     <select name="mata_pelajaran" class="form-control">
                                        <?php foreach ($pelajaran->result() as $r): ?>
                                         <option value="<?= $r->id ?>"

                                         <?php if($a['id_pelajaran'] == $r->id):
                                              echo "selected";
                                              endif;
                                        ?>
                                         ><?= $r->pelajaran ?></option>
                                        <?php   endforeach; ?>
                                     </select>
                    </div>
                 </div>
                 <div class="col-md-5">
                         <div class="form-group">
                                <label>Gambar (1 MB)</label>
                                <input type="file" name="gambar" class="form-control">
                         </div>
                 </div>
                 <input type="submit" class="btn btn-success" value="Edit Pertanyaan">
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