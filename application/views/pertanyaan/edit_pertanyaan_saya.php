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
              <form method="post" action="<?= base_url() ?>edit_pertanyaan_saya">
                 <textarea id="editor1" name="pertanyaan" rows="10" cols="80" placeholder="Tulis pertanyaanmu disini"><?= $a->pertanyaan ?>
                 </textarea><br>
                 <div class="col-md-3">
                    <div class="form-group">
                           <label>Tingkatan : </label>
                                 <select name="tingkat" class="form-control">
                                  <option>SD</option>
                                  <option>SMP</option>
                                  <option>SMA</option>
                                  <option>SMK</option>
                                 </select>
                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="form-group">
                            <label>Mata Pelajaran : </label>
                                     <select name="mata_pelajaran" class="form-control">
                                        <?php foreach ($pelajaran as $r): ?>
                                         <option value="<?= $r->id ?>"

                                         <?php ($a->id_pelajaran == $r->id):
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
                                <label>Wids</label>
                               <select name="wids" class="form-control">
                                <?php for ($i=10; $i <=99 ; $i++) : ?>
                                       <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?> 
                               </select>
                               <small>(Anda memiliki <?= $this->session->userdata('wids')?> Wids)</small>
                         </div>
                 </div>
	</div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>