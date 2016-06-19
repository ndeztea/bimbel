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
          <div class="box-header with-border">
            <h3 class="box-title">Table Pelajaran</h3>
            <button class="btn btn-info btn-md pull-right" onclick=location.href="<?= base_url() ?>tambah_pelajaran"><i class="fa fa-plus-circle"></i> Tambah Data</button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tbody><tr>
                <th style="width: 10px">#</th>
                <th>Mata Pelajaran</th>
                <th>Deskripsi</th>
                <th>Icon</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
              <?php
                  $no = 1;
                  foreach ($database as $r):
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $r->pelajaran ?></td>
                <td><?php echo $r->deskripsi ?></td>
                <td><?php echo $r->params ?></td>
                <td>
                    <?php if($r->is_active == '1'): ?>
                      <span class="label label-success">
                        Aktif
                      </span>
                    <?php else: ?>
                      <span class="label label-danger">
                        Tidak Aktif
                      </span>
                    <?php endif; ?>
                </td>
                <td>
                    <button class="btn btn-success" onclick=location.href='<?= base_url() ?>edit_pelajaran/<?= $r->id ?>'><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger" onclick=location.href='<?= base_url() ?>delete_pelajaran/<?= $r->id ?>'><i class="fa fa-trash"></i></button>


                     <?php if($r->is_active == '1'): ?>
                    <button class="btn btn-danger" onclick=location.href='<?= base_url() ?>set_active_pelajaran/<?= $r->id ?>'><i class="fa fa-times"></i></button>
                    <?php else: ?>
                    <button class="btn btn-success" onclick=location.href='<?= base_url() ?>set_active_pelajaran/<?= $r->id ?>'><i class="fa  fa-check"></i></button> 
                    <?php endif; ?>


                </td>
              </tr>
              <?php endforeach; ?>
            </tbody></table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
</section>    


<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
<?php $this->load->view('template/foot'); ?>