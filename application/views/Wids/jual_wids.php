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
                                   <h3 class="box-title">Penukaran Wids</h3>
                            </div>
                            <div class="box-body">
                                   <?php if($user['wids']>35):?>
                                   <form method="post" action="<?php echo base_url()?>/sell_wids">
                                          <div class="form-group">
                                                 <label>Pilih Penukaran Wids</label>
                                                 <div class="input-group">
                                                 <select name="wids" class="form-control" >
                                                        <option value="25">25 wids dengan voucher pulsa Rp. 10.000</option>
                                                        <option value="50">50 wids dengan voucher pulsa Rp. 20.000</option>
                                                        <option value="75">75 wids dengan voucher pulsa Rp. 30.000</option>
                                                        <option value="100">100 wids dengan voucher pulsa Rp. 40.000</option>
                                                        <option value="125">125 wids dengan voucher pulsa Rp. 50.000 atau transfer ke rekening bank member</option>
                                                        <option value="150">150 wids dengan voucher pulsa Rp. 75.000 atau transfer ke rekening bank member</option>
                                                        <option value="200">200  wids dengan voucher pulsa Rp. 100.000 atau transfer ke rekening bank member</option>
                                                        <option value="300">300 wids dengan voucher pulsa Rp. 150.000 atau transfer ke rekening bank member</option>
                                                        <option value="400">400 wids dengan voucher pulsa Rp. 200.000 atau transfer ke rekening bank member</option>

                                                 </select>
                                                 <!--input type="text" name="kode_voucher" class="form-control" placeholder="Masukan kode voucher"-->
                                                 <span class="input-group-btn">
                                                   <button class="btn btn-primary" type="submit">Request</button>
                                                 </span>
                                              </div>
                                          </div>
                                   </form>
                                   <?php else:?>
                                          <p>Untuk menukar wids harus punya minimal 35 wids</p>
                                   <?php endif?>
                                   <!--ul>
                                          <li>25 wids dengan voucher pulsa Rp. 10.000</li>
                                          <li>50 wids dengan voucher pulsa Rp. 20.000</li>
                                          <li>75 wids dengan voucher pulsa Rp. 30.000</li>
                                          <li>100 wids dengan voucher pulsa Rp. 40.000</li>
                                          <li>125 wids dengan voucher pulsa Rp. 50.000 atau transfer ke rekening bank member</li>
                                          <li>150 wids dengan voucher pulsa Rp. 75.000 atau transfer ke rekening bank member</li>
                                          <li>200  wids dengan voucher pulsa Rp. 100.000 atau transfer ke rekening bank member</li>
                                          <li>300  wids dengan voucher pulsa Rp. 150.000 atau transfer ke rekening bank member</li>
                                          <li>400  wids dengan voucher pulsa Rp. 200.000 atau transfer ke rekening bank member</li>
                                   </ul-->
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