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
                     <div class="box table-responsive">
                            <div class="box-header box-primary with-border">
                                   <h3 class="box-title">Data Reseller</h3>
                            </div>
                            <div class="box-body">
                                   <table class="table table-bordered table-striped" id="data_reseller">
                                          <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Nama</th>
                                              <th>Alamat</th>
                                              <th>No Hp</th>
                                              <th>Aktif</th>
                                              <th>Aksi</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                                 <?php foreach ($reseller->result() as $r): ?>
                                                        <tr>
                                                               <td><?php echo $no++; ?></td>
                                                               <td><?php echo $r->nama; ?></td>
                                                               <td><?php echo $r->alamat; ?></td>
                                                               <td><?php echo $r->no_hp; ?></td>
                                                               <td></td>
                                                               <td></td>
                                                        </tr>
                                                 <?php endforeach; ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <th>No</th>
                                              <th>Nama</th>
                                              <th>Alamat</th>
                                              <th>No HP</th>
                                              <th>Aktif</th>
                                              <th>Aksi</th>
                                            </tr>
                                          </tfoot>
                                        </table>
                            </div>
                     </div>
              </div>

	</div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
<script src="<?php echo base_url() ?>assets/AdminLTE-2.3.0/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url() ?>assets/AdminLTE-2.3.0/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $('#data_reseller').DataTable();
</script>
<script type="text/javascript">
  function confirmDelete(id) {

    if(confirm('Anda yakin untuk menghapus pertanyaan ini ?')){
        <?php $this->session->set_userdata('url_delete', current_url()); ?>
        window.location.href="<?php echo base_url() ?>delete_pertanyaan/"+id
    }
  }
</script>
<?php $this->load->view('template/foot'); ?>