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
            <h3 class="box-title">Table Pelajaran</h3>
            <button class="btn btn-info btn-md pull-right" onclick=location.href="<?= base_url() ?>tambah_pelajaran"><i class="fa fa-plus-circle"></i> Tambah Data</button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-striped" id="data_pelajaran">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Mata Pelajaran</th>
                  <th>Deskripsi</th>
                  <th>Icon</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  $no = 1;
                  foreach ($data_pelajaran as $r):
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $r->pelajaran ?></td>
                <td><?php echo $r->deskripsi ?></td>
                <td  class="text-center"><i class="fa <?php echo $r->params ?>"></i></td>
                <td class="text-center">
                    <?php if($r->is_active == '1'): ?>
                      <span class="label label-success">
                        <a href="javascript:;" style="color:#FFF" onclick="location.href='<?= base_url() ?>set_active_pelajaran/<?= $r->id ?>'">Aktif</a>
                      </span>
                    <?php else: ?>
                      <span class="label label-danger" >
                        <a href="javascript:;"  style="color:#FFF"  onclick="location.href='<?= base_url() ?>set_active_pelajaran/<?= $r->id ?>'">Tidak Aktif</a>
                      </span>
                    <?php endif; ?>
                </td>
                <td  class="text-center">
                    <button onclick="location.href='<?= base_url() ?>edit_pelajaran/<?= $r->id ?>'" class="btn btn-success" ><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger" onclick="confirmDelete('<?= $r->id ?>')"><i class="fa fa-trash"></i></button>


                   
                </td>
              </tr>
              <?php endforeach; ?>
              </tbody>
              </table>
            </div><!-- /.box-body -->
          </div>
        </div>
      </div>
</section>    


<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
<script src="<?= base_url() ?>assets/AdminLTE-2.3.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.3.0/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
      $(function () {
        $('#data_pelajaran').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "aoColumnDefs": [
                            { 'bSortable': false, 
                              'aTargets': [ 0, 2, 3, 4, 5 ] },
                              ]
        });
      });
</script>
<script type="text/javascript">
          function confirmDelete(id) {

            if(confirm('Anda yakin untuk menghapus pelajaran ini ?')){
                window.location.href="<?= base_url() ?>delete_pelajaran/"+id
            }
          }
        </script>
<?php $this->load->view('template/foot'); ?>