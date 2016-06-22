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

              <div class="col-md-12">
                     <div class="box box-primary table-responsive">
                            <div class="box-header">
                                   <h3 class="box-title">Data Pertanyaan Saya</h3>
                            </div>
                            <div class="box-body">
                                   <table class="table table-bordered">
                                          <thead>
                                                 <tr>
                                                        <td>#</td>
                                                        <td>Pertanyaan</td>
                                                        <td>Mata Pelajaran</td>
                                                        <td>Wids</td>
                                                        <td>Aksi</td>
                                                 </tr>
                                          </thead>
                                          <tbody>
                                                 <?php foreach ($pertanyaan->result() as $r): ?>
                                                        <tr>
                                                               <td><?= $no++ ?></td>
                                                               <td><?= $r->pertanyaan ?></td>
                                                               <td><?= $r->nama_pelajaran ?></td>
                                                               <td><?= $r->wids_pertanyaan ?></td>
                                                               <td>
                                                                     <button class="btn btn-success" onclick=location.href='<?= base_url() ?>edit_pertanyaan_saya/<?= $r->id_pertanyaan ?>'><i class="fa fa-pencil"></i></button>
                                                                      <button class="btn btn-danger" onclick=location.href='<?= base_url() ?>delete_pertanyaan_saya/<?= $r->id_pertanyaan ?>'><i class="fa fa-trash"></i></button> 
                                                               </td>
                                                        </tr> 
                                                 <?php endforeach ?>
                                          </tbody>
                                   </table>
                            </div>
                     </div>
              </div>
	</div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>