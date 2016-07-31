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
              <img id="imageProfile" class="profile-user-img img-responsive img-circle" alt="User profile picture" src="<?php echo thumb_avatar($this->session->userdata('avatar'),$this->session->userdata('gender'))?>"
              style="width: 150px; height: 150px; margin: 10px auto;">
            </div>
            <div class="col-md-9">
              <h3><?php echo $this->session->userdata('nama'); ?> (<?php echo $this->session->userdata('wids'); ?> Wids)</h3>
              <h5 style="color:#777"><?php echo $wids ?></h5>
              <hr />
              <table class="table">
                <tr>
                  <td style="border-top: 0px solid #f4f4f4;">NISN</td>
                  <td style="border-top: 0px solid #f4f4f4;">:</td>
                  <td style="border-top: 0px solid #f4f4f4;"><?php echo $users['nisn'] ?></td>
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
                    Kelas <?php echo $users['kelas'] ?> <?php echo get_tingkat($users['tingkat_sekolah']) ?>
                  </td>
                </tr>
                <tr>
                  <td style="border-top: 0px solid #f4f4f4;">Sekolah </td>
                  <td style="border-top: 0px solid #f4f4f4;">:</td>
                  <td style="border-top: 0px solid #f4f4f4;"><?php echo $users['nama_sekolah'] ?></td>
                </tr>
                <tr>
                  <td style="border-top: 0px solid #f4f4f4;">HP</td>
                  <td style="border-top: 0px solid #f4f4f4;">:</td>
                  <td style="border-top: 0px solid #f4f4f4;"><?php echo $users['hp'] ?></td>
                </tr>
                <tr>
                  <td style="border-top: 0px solid #f4f4f4;">Email</td>
                  <td style="border-top: 0px solid #f4f4f4;">:</td>
                  <td style="border-top: 0px solid #f4f4f4;"><?php echo $users['email'] ?></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="box-footer">
            <?php if($users['nisn'] == $this->session->userdata('nisn')): ?>
            <button class="btn btn-md btn-info pull-right" onClick=location.href="<?php echo base_url()?>update_profil/">Edit Profil</button>
            <button class="btn btn-md btn-success pull-right" onClick=location.href="<?php echo base_url()?>update_password/">Edit Password</button>
            <?php endif; ?>
            <button class="btn btn-primary pull-right" onclick=self.history.back()><i class="fa fa-arrow-left"></i> Kembali</button>
            
          </div>
        </div>


        
      </div>

      <div class="col-md-4">
        <?php $this->load->view('template/profil_widget');?>
        <?php $this->load->view('template/ajukan_pertanyaan'); ?>
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