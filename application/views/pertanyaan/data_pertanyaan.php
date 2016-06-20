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
            <h3 class="box-title">Table Pertanyaan</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tbody><tr>
                <th style="width: 10px">#</th>
                <th>Nama Penanya</th>
                <th>Mata Pelajaran</th>
                <th>Wids</th>
                <th>Pertanyaan</th>
                <th>Tingkat</th>
                <th>Aksi</th>
              </tr>
              <?php
                  $no = 1;
                  foreach ($data_pertanyaan as $r):
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $r->nama_penanya ?></td>
                <td><?php echo $r->nama_pelajaran ?></td>
                <td><?php echo $r->wids_penanya ?></td>
                <td><?php echo substr($r->pertanyaan, 0, 100)?></td>
                <td><?php echo $r->tingkat ?></td>
                <td>
                    <button class="btn btn-danger" onclick=location.href='<?= base_url() ?>delete_pertanyaan/<?= $r->id_pertanyaan ?>'><i class="fa fa-trash"></i></button>
                    <button class="btn btn-info" onclick=location.href=''><i class="fa fa-eye"></i></button>
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