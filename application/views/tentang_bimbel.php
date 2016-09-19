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

              <div class="col-md-<?php echo $this->session->userdata('level')!=''?'8':'12'?>">
                     <div class="box">
                            <div class="box-header  with-border box-primary">
                                   <h3 class="box-title">Tentang Bimbel</h3>
                            </div>
                            <div class="box-body">
                            <div class="col-md-12">
                                   <h3>Ucapan selamat datang</h3>
                                   <br>
                                   <hr>
                                         <p>Selamat datang di web kami <a href="">http://www.bmbimbel.com </a>, terima kasih telah menyepatkan diri untuk berkunjung ke web kami senang rasanya bagi kami untuk bisa membangun mitra kerja bersama anda. Untuk menegetahui lebih lanjut tentang web kami silakan untuk membaca bagian selanjutnya </p>

                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                   <h3>Apa itu BMBIMBEL ?</h3>
                                   <br>
                                   <hr>
                                         <p>Web BMBIMBEL merupakan  komunitas belajar mandiri. Komunitas belajar ini sudah berdiri dari 2010 namun baru mulai melakukan ekspansi melalui layanan internet yaitu belajar online lewat web pada tahun 2016. Dalam web ini kita bisa saling bertanya dan menjawab sejumlah pertanyaan dan jawaban. Pada web ini disediakan masing masing mata pelajaran bisa langsung bertanya dengan memposting pada masing masing pelajaran. Kemudian pertanyaan itu akan dijawab oleh tim ahli yang telah ditunjuk oleh perusahaan untuk siap menjumlah pertanyaan yang diajukan pengguna.</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                   <h3>Fitur yang tersedia di Web</h3>
                                   <br>
                                   <hr>
                                          <ol>
                                                 <li> Fitur Mata Pelajaran.
                                                 <br>
                                                 <p>Dalam fitur ini pengguna bisa mengajukan sejumalah pertanyaan pada masing masing mata pelajaran yang sesuai dengan isi pertanyaan tersebut. Kemudian tim ahli bisa menjawab sejumlah pertanyan. Konten isi mata pelajran meliputi matematika, fisika, kimia, biologi, bahasa indonesia, IPS, Kesenian, PKn, dan Penjaskes dll.</p>

                                                 </li>

                                                 <li> Jual dan Beli Wids.
                                                 <br>
                                                 <p>Dalam fitur layanan ini bisa digunakan untuk menjual wids dan membeli wids. Pengguna bisa menjual dengan sejumlah wids yang dia punya pada akunnya. Jumlah wids minimal dengan mencapai batas tertentu dapat ditukar dengan uang ataupun dengan pulsa. Selain dengan menjual pengguna bisa membeli untuk melakukan postingan atau penggunaan fitur dalam web caranya dengan melakukan transfer pada nomor rekening perusahaan untuk mendapat sejumlah wids. Pengguna juga bisa melakuan transaksi wids dengan mengirim sejumlah wids ke pengguna yang lainnya.</p>
                                                              
                                                 </li>
                                                 <li> Chatting
                                                 <br>
                                                 <p>Pengguna bisa melalkukan chating dengan costumer servis apabila ada pertanyaan seputar penggunaan web ini. Dan untuk keluhan serta dapat juga digunakan untuk adanya kendala dalam web ini </p>
                                                 </li>

                                          </ol>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                   <h3>Apa itu WIDS ?</h3>
                                   <br>
                                   <hr>
                                          <p>Pengguna bisa melalkukan chating dengan costumer servis apabila ada pertanyaan seputar penggunaan web ini. Dan untuk keluhan serta dapat juga digunakan untuk adanya kendala dalam web ini </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                   <h3>Cara Mendapatkan Wids </h3>
                                   <br>
                                   <hr>
                                          <p></p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                   <h3>Customer Servis </h3>
                                   <br>
                                   <hr>
                                          <p>Pengguna bisa menghubungi costumer servis untuk keperluan seputar pengguanaan web. Apabila ada kendala, keluhan, serta kesulitan transaksi bisa dihubungi via fitur chating yang menghubugkan pengguna dengan costumer servis. Costumer servis siap melayani anda dengan sebaik baiknya.  
</p>
                            </div>
                            <div class="clearfix"></div>
                            </div>
                     </div>
              </div>
              <?php if ($this->session->userdata('level')!=''): ?>
              <div class="col-md-4">
                     <?php $this->load->view('template/ajukan_pertanyaan'); ?>
                     <?php $this->load->view('template/profil_widget');?>
              </div>
              <?php endif?>

	</div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>