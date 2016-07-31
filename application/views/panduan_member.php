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
                     <div class="box">
                            <div class="box-header  with-border box-primary">
                                   <h3 class="box-title">Panduan Member</h3>
                            </div>
                            <div class="box-body">
                            <div class="col-md-12">
                                   <h3>Penukaran Wids</h3>
                                   <br>
                                   <hr>
                                          <ol>
                                                 <li> Member yang membeli wids bisa memasukan kode wids pada menu pembelian wids dengan memasukan kode yang sudah diberikan.</li>
                                                 <li> Member bisa menukarkan wids dengan beberapa voucher yang disediakan. </li>
                                          </ol>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                   <h3>Peraturan Member</h3>
                                   <br>
                                   <hr>
                                          <ol>
                                                 <li> Setiap pertanyaan minimal menggunakan 2 wids.  Member hanya berhak bertanya 1 soal saja di setiap pertanyaan. Jika member mengunakan 2 pertanyaan lebih maka dalam hal ini member lain hanya wajib menjawab pertanyaan pertama saja sehingga pertanyaan kedua tidak berlaku.</li>

                                                 <li>Banyak nya wids yang dikeluarkan tergantung dari tingkat kesulitas soal yang di berikan oleh member yang bertanya.</li>

                                                 <li> Member yang ingin menjawab pertanyaan member lainya harus dengan keinginan ingin menjawab dengan benar.</li>

                                                 <li> Member yang menjawab dengan benar dan paling awal menjawab maka member akan mendapatkan  wids yang diberikan oleh member yang bertanya dengan persetujuan admin web.</li>

                                                 <li> Jika Member menjawab pertanyaan dengan asal asalan akan di banned oleh admin dan secara tidak langsung wids yang dimiliki oleh member akan terhapus.</li>

                                          </ol>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                   <h3>Peraturan wids</h3>
                                   <br>
                                   <hr>
                                          <ol>
                                                 <li> Wids adalah alat tukar yang gunakan untuk membeli, menjual dan menukar dengan voucher maupun transfer.</li>

                                                 <li> Member yang ingin memiliki wids ada 3 (cara) untuk memillikinya :
                                                        <ul>
                                                               <li> Member bisa membeli wids melalui admin atau pun reseller. Jika melalui admin member bisa transfer ke rekening yang sudah tersedia dan tidak menggunakan rekening di luar yang tersedia di web.</li>
                                                               <li> Member bisa menjawab pertanyaan member lain. Jika member menjawab dengan benar maka secara tidak langsung member akan memiliki wids yang di berikan oleh member yang bertanya melalui koreksi pihak admin.</li>
                                                               <li> Jika member mengajak peserta lain untuk menjadi member dan member yang baru membeli wids bukan menjawab pertanyaan maka member yang mengajak member baru akan memiliki 10% dari jumlah wids yang dimasukan dalam pembelian voucher wids.</li>
                                                        </ul>

                                                 </li>

                                          </ol>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                   <h3>Penukaran Voucher</h3>
                                   <br>
                                   <hr>
                                          <ol>
                                                 <li> Member bisa menukar wids yang dimiliki untuk ditukar dengan voucher serta hal lainnya yang tersedia.</li>

                                                 <li> Saldo Minimal 10 wids jika setelah ditukarkan jika belum memenuhi maka member belum bisa menukarkan wids yang dipunyai.</li>

                                                 <li> Jika memenuhi syarat dalam menukarkan wids maka member akan menukar wids terhadap voucher ataupun transfer dengan ketentuan data yang ditukar sudar benar.</li>

                                                 <li> Voucher yang sudah di tukar tidak bisa batalkan.</li>

                                          </ol>
                            </div>
                            <div class="clearfix"></div>
                            </div>
                     </div>
              </div>

              <div class="col-md-4">
                     <?php $this->load->view('template/ajukan_pertanyaan'); ?>
                     <?php $this->load->view('template/profil_widget');?>
              </div>

	</div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>