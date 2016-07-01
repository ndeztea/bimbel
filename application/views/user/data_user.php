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
          <div class="col-md-12">
            <div class="box box-primary table-responsive">
              <div class="box-header">
                <h3 class="box-title">Data Users</h3>
              </div>
              <div class="box-body">
                <table class="table table-bordered">
                  <thead>
                    <th>#</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Sekolah</th>
                    <th>Wids</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                      <?php foreach ($users->result() as $r): ?>
                        <tr>
<<<<<<< Updated upstream
                          <td><?= $no++ ?></td>
                          <td><?= $r->nisn ?></td>
                          <td><?= $r->nama ?></td>
                          <td class="text-center"><?= $r->kelas ?></td>
                          <td><?= $r->nama_sekolah ?></td>
                          <td class="text-center"><?= $r->wids ?></td>
                          <td  class="text-center">
=======
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $r->nisn ?></td>
                          <td><?php echo $r->nama ?></td>
                          <td><?php echo $r->kelas ?></td>
                          <td><?php echo $r->nama_sekolah ?></td>
                          <td>
>>>>>>> Stashed changes
                              <?php if($r->is_active == '1'): ?>
                              <span class="label label-success">
                                 <a href="javascript:;"  onclick="location.href='<?= base_url() ?>set_active_user/<?= $r->nisn ?>'" style="color:#FFF">Aktif</a>
                              </span>
                              <?php else: ?>
                              <span class="label label-danger">
                              <a href="javascript:;"  onclick="location.href='<?= base_url() ?>set_active_user/<?= $r->nisn ?>'" style="color:#FFF">Tidak Aktif</a>
                              </span>
                              <?php endif; ?>
                          </td>
<<<<<<< Updated upstream
                          <td  class="text-center">
                            <button class="btn btn-success" onclick="location.href='<?= base_url() ?>edit_user/<?= $r->nisn ?>'"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger" onclick="location.href='<?= base_url() ?>delete_user/<?= $r->nisn ?>'"><i class="fa fa-trash"></i></button>

                             <button class="btn btn-primary" onclick="location.href='<?= base_url() ?>data_wids/<?= $r->nisn?>'">Wids</button>
=======
                          <td>
                            <button class="btn btn-success" onclick=location.href='<?php echo base_url() ?>edit_user/<?php echo $r->nisn ?>'><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger" onclick=location.href='<?php echo base_url() ?>delete_user/<?php echo $r->nisn ?>'><i class="fa fa-trash"></i></button>


                            <?php if($r->is_active == '1'): ?>
                              <button class="btn btn-danger" onclick=location.href='<?php echo base_url() ?>set_active_user/<?php echo $r->nisn ?>'><i class="fa fa-times"></i></button>
                            <?php else: ?>
                              <button class="btn btn-success" onclick=location.href='<?php echo base_url() ?>set_active_user/<?php echo $r->nisn ?>'><i class="fa  fa-check"></i></button> 
                            <?php endif; ?>

                            <button class="btn btn-primary" onclick=location.href="<?php echo base_url() ?>data_wids/<?php echo $r->nisn?>">Wids</button>
>>>>>>> Stashed changes
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