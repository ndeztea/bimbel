<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->
<link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE-2.3.0/plugins/datatables/dataTables.bootstrap.css">

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
          <div class="box-header with-border">
            <h3 class="box-title">Table Pertanyaan</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped" id="data_pertanyaan">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Penanya</th>
                  <th>Mata Pelajaran</th>
                  <th>Wids</th>
                  <th>Pertanyaan</th>
                  <th>Tingkat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Nama Penanya</th>
                  <th>Mata Pelajaran</th>
                  <th>Wids</th>
                  <th>Pertanyaan</th>
                  <th>Tingkat</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
            </table>
            </div>
        </div>
      </div>
</section>    


<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
<script src="<?= base_url() ?>assets/AdminLTE-2.3.0/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?= base_url() ?>assets/AdminLTE-2.3.0/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $('#data_pertanyaan').DataTable({
        ordering:false,
        processing: true,
        serverSide: true,
        searchable:true,
        ajax: {
          url: "<?php echo base_url('pertanyaan/pertanyaan_list') ?>",
          type:'POST',
        }
    });
</script>
<script type="text/javascript">
  function confirmDelete(id) {

    if(confirm('Anda yakin untuk menghapus pertanyaan ini ?')){
        window.location.href="<?= base_url() ?>delete_pertanyaan/"+id
    }
  }
</script>

<?php $this->load->view('template/foot'); ?>