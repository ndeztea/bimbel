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
              <label>Cari berdasarkan Level :</label>
              <select name="pelajaran" class="form-control" id="level">
                <option value="">Semua</option>
                <option value="1">Superadmin</option>
                <option value="2">Administrator</option>
                <option value="3">Reseller</option>
                <option value="4">Member</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    <div class="clearfix"></div>
      <div class="col-md-12">
        <div class="box box-primary table-responsive">
          <div class="box-header with-border">
            <h3 class="box-title">Table User</h3>
            <button class="btn btn-success pull-right" onclick=location.href="<?= base_url() ?>add_user"><i class="fa fa-plus-circle" ></i> Tambah user </button>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped" id="data_user">
              <thead>
                <tr>
                  	<th class="no-sort">#</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Sekolah</th>
                    <th>Wids</th>
                    <th>Status</th>
                    <th>Level</th>
                    <th class="no-sort">Aksi</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Sekolah</th>
                  <th>Wids</th>
                  <th>Status</th>
                  <th>Level</th>
                  <th >Aksi</th>
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
    var table =  $('#data_user').DataTable({
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
          url: "<?= base_url('user/user_list') ?>",
          type:'POST',
          data:function(d){
            d.keyword = $("#keyword").val();
            d.level = $("#level").val();
          }
        })
    });

    $('#keyword').on('keyup change', function(){
      table.ajax.reload();
    });
    $('#level').on('change', function(){
      table.ajax.reload();
    });
</script>
<script type="text/javascript">
  function confirmDelete(id) {

    if(confirm('Anda yakin untuk menghapus user ini ?')){
        window.location.href="<?php echo base_url() ?>delete_user/"+id;
    }
  }
</script>

<?php $this->load->view('template/foot'); ?>