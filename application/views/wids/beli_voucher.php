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

              <div class="col-md-8">
                     <div class="box box-primary">
                            <div class="box-header">
                                   <h3 class="box-title">Pembelian Wids</h3>
                            </div>
                            <div class="box-body">
                                   <form method="post" action="<?php echo base_url()?>buy">
                                          <div class="form-group">
                                                 <label>Masukkan Kode Voucher</label>
                                                 <div class="input-group">
                                                 <input type="text" name="kode_voucher" class="form-control" placeholder="Masukan kode voucher">
                                                 <span class="input-group-btn">
                                                   <button class="btn btn-primary" type="submit">Purchase</button>
                                                 </span>
                                              </div>
                                          </div>
                                   </form>
                                   <ul>
                                          <li>Harga wids yang berlaku Rp. 12.000,- untuk 16 wids </li>
                                          <li>Harga wids yang berlaku Rp. 22.000,- untuk 32 wids</li>
                                          <li>Harga wids yang berlaku Rp. 32.000,- untuk 48 wids</li>
                                          <li>Harga wids yang berlaku Rp. 42.000,- untuk 64 wids</li>
                                          <li>Harga wids yang berlaku Rp. 52.000,- untuk 80 wids</li>
                                          <li>Harga wids yang berlaku Rp. 62.000,- untuk 96 wids</li>
                                          <li>Harga wids yang berlaku Rp. 72.000,- untuk 112 wids</li>
                                          <li>Harga wids yang berlaku Rp. 102.000,- untuk 160 wids</li>
                                          <li>Harga wids yang berlaku Rp. 152.000,- untuk 240 wids</li>
                                          <li>Harga wids yang berlaku Rp. 200.000,- untuk 320 wids</li>
                                   </ul>
                                   <p>Pembelian wids bisa transfer menggunakan rekening Bank atau melalui resseler resmi  kami, Adapun rekening yang digunakan :<br>
                                   Bank Mandiri Atas nama <strong>Widiana Gumilar </strong> No. <strong>131-001-199-179-3  </strong>
(di luar ini tidak berlaku)</p>
<p>Hubungi <br>BBM  Pin : <strong>512CD555</strong><br>
Whats up   : <strong>085220903259</strong><br>
Line : <strong>widi_g</strong><br>
Follow ig : <strong>bm_bimbel</strong></p>
                            </div>
                     </div>
              </div>
              <div class="col-md-4">
                     <?php $this->load->view('template/profil_widget'); ?>
                     <?php $this->load->view('template/ajukan_pertanyaan'); ?>
              </div>

	</div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>