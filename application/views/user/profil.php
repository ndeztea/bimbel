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
      <div class="col-md-8">
        <div class="box box-primary table-responsive">
          <div class="box-body box-profile">
            <div class="col-md-3">
              <img id="imageProfile" class="profile-user-img img-responsive img-circle" alt="User profile picture" src="<?= base_url('assets/images/avatar')."/".$this->session->userdata('avatar'); ?>"
              style="width: 150px; height: 150px; margin: 10px auto;">
            </div>
            <div class="col-md-9">
              <h3><?= $this->session->userdata('nama'); ?> (<?= $this->session->userdata('wids'); ?> Wids)</h3>
              <h5 style="color:#777"><?= $wids ?></h5>
              <hr />
              <table class="table">
                <tr>
                  <td style="border-top: 0px solid #f4f4f4;">NISN</td>
                  <td style="border-top: 0px solid #f4f4f4;">:</td>
                  <td style="border-top: 0px solid #f4f4f4;"><?= $users['nisn'] ?></td>
                </tr>
                <tr>
                  <td style="border-top: 0px solid #f4f4f4;">Jenis Kelamin</td>
                  <td style="border-top: 0px solid #f4f4f4;">:</td>
                  <td style="border-top: 0px solid #f4f4f4;">
                    <?php switch ($users['gender']) {
                    case 'l':
                    echo "Laki-laki";
                    break;
                    
                    default:
                    echo "Perempuan";
                    break;
                    } ?>
                  </td>
                </tr>
                <tr>
                  <td style="border-top: 0px solid #f4f4f4;">Tingkat Pendidikan </td>
                  <td style="border-top: 0px solid #f4f4f4;">:</td>
                  <td style="border-top: 0px solid #f4f4f4;">
                    Kelas <?= $users['kelas'] ?> <?= get_tingkat($users['tingkat_sekolah']) ?>
                  </td>
                </tr>
                <tr>
                  <td style="border-top: 0px solid #f4f4f4;">Sekolah </td>
                  <td style="border-top: 0px solid #f4f4f4;">:</td>
                  <td style="border-top: 0px solid #f4f4f4;"><?= $users['nama_sekolah'] ?></td>
                </tr>
                <tr>
                  <td style="border-top: 0px solid #f4f4f4;">HP</td>
                  <td style="border-top: 0px solid #f4f4f4;">:</td>
                  <td style="border-top: 0px solid #f4f4f4;"><?= $users['hp'] ?></td>
                </tr>
                <tr>
                  <td style="border-top: 0px solid #f4f4f4;">Email</td>
                  <td style="border-top: 0px solid #f4f4f4;">:</td>
                  <td style="border-top: 0px solid #f4f4f4;"><?= $users['email'] ?></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="box-footer">
            <?php if($users['nisn'] == $this->session->userdata('nisn')): ?>
            <button class="btn btn-md btn-info pull-right" onClick=location.href="<?= base_url()?>update_profil/">Edit Profil</button>
            <?php endif; ?>
          </div>
        </div>


        <div class="box box-primary table-responsive">
          <div class="box-header with-border">
            <h2 class="box-title">Pertanyaan yang saya jawab</h2>
          </div>
          <div class="box-body box-comments">
            <?php foreach ($jawaban->result() as $r): ?>
            <div class="box-comment">
              <img class="img-circle img-sm" src="
              <?= base_url('assets/images/avatar/')."/".$this->session->userdata('avatar'); ?>" alt="user image">
              <div class="comment-text">
                <span class="username">
                  <?= $r->nama_pelajaran ?>&middot;
                  <?= $r->wids ?> Wids &middot;
                  <?= get_tingkat($r->tingkat) ?>
                </span>
                <a href="<?= base_url() ?>detail_pertanyaan/<?= $r->id_pertanyaan ?>"><?= $r->pertanyaan ?></a>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="box box-primary table-responsive">
          <div class="box-header with-border">
            <h3 class="box-title">List Pertanyaan Saya</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered">
              <tbody><tr>
                <th style="width: 10px">#</th>
                <th>Pertanyaan</th>
              </tr>
              <?php
              $no =1;
              foreach ($pertanyaan_saya->result() as $r) : ?>
              <tr>
                <td><?= $no ++ ?></td>
                <td><?= $r->pertanyaan?></td>
              </tr>
              <?php endforeach ?>
            </tbody></table>
          </div>
          <div class="box-footer clearfix">
            <a href="<?= base_url() ?>my_question">Tampilkan Semua Pertanyaan</a>
          </div>
        </div>
      </div>
    </div>
</section>

	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
<script type="text/javascript">
	 function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#imageProfile').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	  }

	  $("#imgProfile").change(function(){
	      readURL(this);
	  });
</script>
<?php $this->load->view('template/foot'); ?>