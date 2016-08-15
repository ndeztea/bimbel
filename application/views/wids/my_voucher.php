<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<?php
              if($this->session->flashdata('msg_error') != NULL){
              echo '<div class="alert alert-danger" role="alert" style="padding: 6px 12px;height:34px;">';
              echo "<i class='fa fa-info-circle'></i><strong><span style='margin-left:10px;'>".$this->session->flashdata('msg_error')."</span></strong>";
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
              <div class="box box-primary table-responsive">
                     <div class="box-header">
                            <h3 class="box-title">Data Voucher Wids</h3>
                     </div>
                     <div class="box-body">
                            <table class="table">
                                   <thead>
                                          <tr>
                                                 <td>No</td>
                                                 <td>Kode Voucher</td>
                                                 <td>Jumlah Wids</td>
                                                 <td>Status</td>
                                                 <td>Keterangan</td>
                                          </tr>
                                   </thead>
                                   <tbody>
                                          <?php foreach ($wids->result() as $r): ?>
                                                 <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $r->kode_voucher ?></td>
                                                        <td><?php echo $r->wids ?></td>
                                                        <td>
                                                               <?php if($r->telah_ditukar == "0"): ?>
                                                                 <span class="label label-success">
                                                                      Belum Ditukar
                                                                 </span>     
                                                               <?php else: ?>
                                                                 <span class="label label-danger">
                                                                      Sudah Ditukar
                                                                 </span>
                                                               <?php endif; ?>
                                                               
                                                        </td>
                                                        <td><?php echo $r->keterangan ?></td>
                                                 </tr>
                                          <?php endforeach; ?>    
                                   </tbody>
                            </table>
                     </div>
                     <div class="box-footer">
                            <button class="btn btn-success pull-right" onclick=self.history.back()>Kembali</button>
                     </div>
              </div>
	</div>
</section>

<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>