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
                            <button type="button" class="btn btn-primary pull-right" id="modal-trigger" data-toggle="modal" data-target="#myModal">
                              <i class="fa fa-plus-circle"></i> Tambah Data
                            </button>
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
                                                 <td>Aksi</td>
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
                                                        <td>
                                                               <button class="btn btn-info"><i class="fa fa-pencil"></i></button>
                                                               <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                        </td>
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

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="POST" action="<?php echo base_url() ?>add_voucher">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Voucher</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Kode Voucher</label>
          <div class="input-group">
            <input type="text" name="kode_voucher" id="kode_voucher" class="form-control" placeholder="Kode Voucher" readonly="">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="reload"><i class="fa fa-refresh"></i></button>
            </span>
          </div>
        </div>
        <div class="form-group">
          <label>Jumlah Wids</label>
          <input type="number" name="wids" class="form-control" placeholder="Wids">
        </div>
        <div class="form-group">
          <label>Pilih Peruntukan <small>(jika untuk reseller)</small></label>
          <select name="peruntukan" class="peruntukan form-control">
              <option value="">Untuk user langsung</option>
          </select>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>

<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
<script type="text/javascript">
  $(document).on('click', '#modal-trigger',function() {
      $.ajax({
          url: "<?php echo base_url() ?>Wids/randomString",
          type: 'POST',
          success: function(response){
              if(response){
                $("#kode_voucher").val(response);
              }
            }
      });

      $(".peruntukan").select2({
              width:'100%',
              allowClear:true,
              ajax: {
                url: "<?php echo base_url() ?>reseller/cari_reseller",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                    q: params.term
                  };
                },
                processResults: function (data) {
                  return {
                    results: data
                  };
                },
                cache: true
              },
              placeholder: {
              id: '0', // the value of the option
              text: 'Kosongkan jika untuk user'},
              minimumInputLength: 1,
      });
  });

  $("#reload").click(function(){
      $.ajax({
          url: "<?php echo base_url() ?>Wids/randomString",
          type: 'POST',
          success: function(response){
              if(response){
                $("#kode_voucher").val(response);
              }
            }
      });
  });

</script>
<?php $this->load->view('template/foot'); ?>