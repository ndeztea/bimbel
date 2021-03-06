<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/AdminLTE-2.3.0/plugins/datatables/dataTables.bootstrap.css">

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
       <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Pencarian</h3>
          </div>
          <div class="box-body">
            <div class="col-md-4">
              <label>Cari berdasarkan kata kunci :</label>
              <input type="text" id="keyword" class="form-control">
            </div>
            <div class="col-md-4">
              <label>Cari berdasarkan Mata Pelajaran :</label>
              <select name="pelajaran" class="form-control" id="mapel">
                <option value="">Semua</option>
                <?php foreach ($pelajaran->result() as $r): ?> 
                  <option value="<?php echo $r->id ?>"><?php echo $r->pelajaran ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
        </div>
      </div>
    <div class="clearfix"></div>
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
<script src="<?php echo base_url() ?>assets/AdminLTE-2.3.0/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url() ?>assets/AdminLTE-2.3.0/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
   var table =  $('#data_pertanyaan').DataTable({
        ordering: false,
        processing: true,
        serverSide: true,
        "bFilter" : false,
        responsive:true,
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
      } ],
        "ajax": ({
          url: "<?= base_url('pertanyaan/pertanyaan_list') ?>",
          type:'POST',
          data:function(d){
            d.keyword = $("#keyword").val();
            d.mapel = $("#mapel").val();
          }
        })
    });

    $('#keyword').on('keyup change', function(){
      table.ajax.reload();
    });
    $('#mapel').on('change', function(){
      table.ajax.reload();
    });
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