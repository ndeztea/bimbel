<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>
<section class="content">
       <div class="row">
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
                <h3 class="box-title">Log Wids</h3>
                <button class="btn btn-info btn-md pull-right" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Manage Wids</button>    
              </div>
              <div class="box-body">
                <table class="table table-bordered">
                  <thead>
                    <th>#</th>
                    <th>User</th>
                    <th>Wids</th>
                    <th>Tanggal Update</th>
                    <th>Acttion</th>
                    <th>Keterangan</th>
                  </thead>
                  <tbody>
                      <?php $no =1;
                       foreach ($wids->result() as $r): ?>
                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $r->nama ?></td>
                          <td><?php echo $r->wids ?></td>
                          <td><?php echo $r->tgl_update ?></td>
                          <td><?php echo $r->action ?></td>
                          <td><?php echo $r->keterangan?></td>
                        </tr>
                      <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
</section>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form method="POST" action="<?php echo base_url() ?>wids_action/<?php echo $this->uri->rsegment(3) ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Manage Wids</h4>
      </div>
      <div class="modal-body">
             <div class="form-group">
                     <label>Wids : </label>
                     <input type="text" name="wids" class="form-control">
             </div>
             <div class="form-group">
                    <label>Aksi : </label>
                    <select class="form-control" name="aksi">
                           <option value="tambah">Tambah</option>
                           <option value="kurang">Kurang</option>
                    </select>
             </div>
             <div class="form-group">
                    <label>Keterangan :</label>
                    <input type="text" name="keterangan" class="form-control">
             </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
     </form>
    </div>
  </div>
</div>

<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>